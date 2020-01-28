<?php

namespace Tracker;

use Tables;

class TrackerShedule
{
        //Метод, по закрытию смен в 12 ночи
    public static function nightBreaker()
    {
            //Получаем текущий час по UTC и от него получаем 2 часовых пояса, в которых сейчас полночь
            //Часовые пояса могут быть и не валидны (не существующие), но это не важно. Значит таких юзеров просто не будет
        $utcHour = gmdate('G');
        $offset1 = '-'.str_pad($utcHour.'00', 4 , '0', STR_PAD_LEFT);
        $offset2 = '+'.str_pad((24-$utcHour).'00', 4, '0', STR_PAD_LEFT);
            //Получаем все открытые смены, которые привязаны к юзерам в полуночных поясах
        $workday = Tables\WorkdayTable::getList([
            'select' => [
                '*', 
                'profile'
            ],
            'filter' => [
                'LOGIC' => 'OR',
                [
                    'date_stop' => '',
                    'TABLES_WORKDAY_profile_offset' => $offset1,
                ],
                [
                    'date_stop' => '',
                    'TABLES_WORKDAY_profile_offset' => $offset2,
                ]
            ]
        ]);
            //Закрываем все полуночные смены
            //использую метод stopDay, чтоб было покороче.
            //Можно напрямую написать закрытие смены, это сэкономило бы пару лишних select'ов на каждом юзере
        while ($res = $workday->fetch()){
            $userToClose = new UserTracker($res['profile_id']);
            $userToClose->stopDay();
        }
    }
}
