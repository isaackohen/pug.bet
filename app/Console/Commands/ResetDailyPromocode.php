<?php

namespace App\Console\Commands;

use App\Models\BonusHistory;
use Illuminate\Console\Command;

class ResetDailyPromocode extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bulkbet:resetDailyPromocode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset daily promocode usage';

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
    public function handle() {
        BonusHistory::query()->update([
            'promocode_usedtoday' => 0
        ]);
    }

}
