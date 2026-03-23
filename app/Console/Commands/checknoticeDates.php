<?php

namespace App\Console\Commands;
use App\Models\Notices;
use App\Notifications\NoticeAlert;
use Carbon\Carbon;

use Illuminate\Console\Command;

class checknoticeDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:checknotice-dates';
    protected $description = 'Check notice dates and maintance here';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $warningDate = Carbon::today()->addDays(5)->toDateString();

        $expiringsoon = Notices::where('expire_date', $warningDate)->get();

        foreach ($expiringsoon as $notice) {
            $notice->user->notify(new NoticeAlert($notice, "Notice {$notice->name} Expire in 5 days"));
        }

        $maintanceDue = Notices::where('maintace_date', $today)->get();

        foreach ($maintanceDue as $notice){
            $notice->user->notify(new NoticeAlert($notice, "Notice {$notice->name} Maintence Due Today"));
        }
    }
}
