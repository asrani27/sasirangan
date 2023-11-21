<?php

namespace App\Console\Commands;

use App\Cronjob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EWSCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Early Warning System';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //EWS dan notif ke wa
        $n = new Cronjob;
        $n->cronjob = Carbon::now()->format('Y-m-d H:i:s');
        $n->save();
        $this->info('Berhasil di simpan ' . Carbon::now()->format('Y-m-d H:i:s'));
    }
}
