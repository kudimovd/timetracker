<?php

namespace Tables;

use Bitrix\Main\Entity;

class PauseTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'workday_pause';
    }

    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
            ],
            'workday_id' => [
                'data_type' => 'integer',
                'required' => true,
            ],
            'workday' => new Entity\ReferenceField(
                'workday',
                ProfileTable::class,
                [
                    '=this.workday_id' => 'ref.id',
                ],
                ['join_type' => 'INNER']
            ),
            'date_start' => [
                'data_type' => 'datetime',
            ],
            'date_stop' => [
                'data_type' => 'datetime',
            ],
        ];
    }
}
