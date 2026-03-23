<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('notice:check')->dailyAt('09.00');
