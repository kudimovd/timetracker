<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    //Метод принудительной остановки рабочей смены у всех в 12 ночи
Tracker\TrackerShedule::nightBreaker();