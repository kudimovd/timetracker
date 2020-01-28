<?php

namespace Tables;

use Bitrix\Main\Entity;

class WorkdayTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'workday';
    }

    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
            ],
            'profile_id' => [
                'data_type' => 'integer',
                'required' => true,
            ],
            'profile' => new Entity\ReferenceField(
                'profile',
                ProfileTable::class,
                [
                    '=this.profile_id' => 'ref.id',
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
