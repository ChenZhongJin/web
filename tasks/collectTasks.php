<?php

use Crunz\Schedule;
$schedule = new Schedule();
$path = __DIR__ .'/../';
$schedule->run("php $path/think task:collect")       
        ->everyMinute()
        ->description('Create a backup of the project directory.');
return $schedule;