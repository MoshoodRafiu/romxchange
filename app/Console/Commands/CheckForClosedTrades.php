<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CheckForClosedTrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'closedTrades:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for closed trades and cancel them';

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
        $trades = DB::table('trades')
            ->where('transaction_status', 'pending')
            ->where('trade_window_expiry', '<', date('Y-m-d H:i:s', strtotime(now())))
            ->update(['transaction_status' => 'cancelled']);
        echo "Operation Completed";
    }
}
