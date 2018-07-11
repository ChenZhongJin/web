<?php

use Crunz\Schedule;
$schedule = new Schedule();

$schedule->run(function(){
        $body = visit();
})       
        ->everyMinute()
         ->description('Create a backup of the project directory.');
return $schedule;