<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

  //команды Artisan
  protected $commands = [];

  //расписание команд
  protected function schedule(Schedule $schedule) {
    //$schedule->command('inspire')->hourly();
  }

  //регистрация команд
  protected function commands() {
    $this->load(__DIR__ . '/Commands');
    require base_path('routes/console.php');
  }
}
