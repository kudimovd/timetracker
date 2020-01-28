<?php

namespace Tracker;

use Tables;
use Bitrix\Main\Type\DateTime;

class UserTracker
{
    private $profileId;
    private $currentWorkdayId = NULL;
        //Нам почти во всех методах надо знать есть ли такой юзер и начал ли он рабочий день
        //Сохранил ID профиля и ID смены и вынес их получение в конструктор 
    function __construct($id)
    {
        $profileResult = Tables\ProfileTable::getByPrimary(['id' => $id]);
        
        if ($profileRow = $profileResult->fetch()){
            $this->profileId = $profileRow['id'];
        }else{
            return false;
        }


        $workdayResult = Tables\WorkdayTable::getList([
            'select' => [
                'id'
            ],
            'filter' => [
                'date_stop' => '',
                'profile_id' => $this->profileId,
            ],
            'order' => [
                'date_start' => 'DESC'
            ],
            'limit' => 1
        ]);

        if ($workdayRow = $workdayResult->fetch()){
            $this->currentWorkdayId = $workdayRow['id'];    
        }

    }
        //Бестолковый метод получения объекта DateTime для сохранения в БД в поясе UTC
        //Какой часовой пояс не поставь - сохраняется одно и тоже. Но оставил как есть.
    private static function getUTCTime()
    {
        $time = new DateTime;
        
        $TZ = new \DateTimeZone(UTC);
        $time->setTimeZone($TZ);

        $time->createFromTimestamp(time());
        return $time;
    }
        //Проверяю, что у юзера нет открытых смен
        //Сохранение в БД текущего времени, как начало смены юзера
    public function startDay()
    {
        if (!is_null($this->currentWorkdayId)){
            return false;
        }

        $result = Tables\WorkdayTable::add([
            'profile_id' => $this->profileId,
            'date_start' => self::getUTCTime(),
        ]);

        if ($result->isSuccess())
        {
            $this->currentWorkdayId = $result->getId();
        }
    }
        //Проверяю, что у юзера открыта смена.
        //Сохраняю текущее время, как конец смены
    public function stopDay()
    {
        if (is_null($this->currentWorkdayId)){
            return false;
        }
        
        $result = Tables\WorkdayTable::update($this->currentWorkdayId, [
            'date_stop' => self::getUTCTime()
        ]);

    }
        //Проверяю, что у юзера открыта смена
        //Добавляю запись в таблицу пауз
    public function pauseDay()
    {
        if (is_null($this->currentWorkdayId)){
            return false;
        }
        
        $result = Tables\PauseTable::add([
            'workday_id' => $this->currentWorkdayId,
            'date_start' => self::getUTCTime(),
        ]);
    }
        //Получаю запись с незакрытой паузой
        //Добавляю окончание паузы
    public function unPauseDay()
    {
        if (is_null($this->currentWorkdayId)){
            return false;
        }

        $pauseResult = Tables\PauseTable::getList([
            'select' => [
                'id'
            ],
            'filter' => [
                'date_stop' => '',
                'workday_id' => $this->currentWorkdayId,
            ],
            'order' => [
                'date_start' => 'DESC'
            ],
            'limit' => 1
        ]);

        if ($pauseRow = $pauseResult->fetch()){
            Tables\PauseTable::update($pauseRow['id'], [
                'date_stop' => self::getUTCTime()
            ]);    
        }
    }
}
