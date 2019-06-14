<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class DeleteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deletedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $inhabitants = DB::table('inhabitants')->where('deleted_at', '<', Carbon::now()->subYears(5))->delete();
        $households = DB::table('households')->where('deleted_at', '<', Carbon::now()->subYears(5))->delete();
        $users = DB::table('users')->where('deleted_at', '<', Carbon::now()->subDay(30))->delete();
        $userArchive = DB::table('users')
                ->whereNull('deleted_at')
                ->where('created_at','<', Carbon::now()->subDay(3))
                ->whereNull('email_verified_at')
                ->delete();
    }
}
