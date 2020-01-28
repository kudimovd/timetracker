<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    //создаём трекер для пользователя id=1
$uTrack = new Tracker\UserTracker('1');

    //Стартуем, ставим на паузу, запускаем и останавливаем его день. С интервалом в 2 сек
$uTrack->startDay();
sleep(2);
$uTrack->pauseDay();
sleep(2);
$uTrack->unPauseDay();
sleep(2);
$uTrack->stopDay();