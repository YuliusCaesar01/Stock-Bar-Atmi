<?php

namespace App\Console\Commands;

use App\Http\Controllers\BarangController;
use Illuminate\Console\Command;

class DailyStockRecapCommand extends Command
{
    protected $signature = 'recap:daily';
    protected $description = 'Update daily stock recap';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Trigger the daily stock recap function
        $controller = new BarangController();
        $controller->getDailyStockRecap(new \Illuminate\Http\Request());

        $this->info('Daily stock recap updated successfully.');
    }
}

