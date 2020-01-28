<?php

namespace Tables;

use Bitrix\Main\Entity;

class ProfileTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'profile';
    }

    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true
            ],
            'login' => [
                'data_type' => 'string',
                'required' => true
            ],
            'name' => [
                'data_type' => 'string'
            ],
            'last_name' => [
                'data_type' => 'string'
            ],
            'offset' => [
                'data_type' => 'string'
            ],
        ];
    }
}
