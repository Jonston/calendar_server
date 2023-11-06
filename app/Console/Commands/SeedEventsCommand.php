<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
class SeedEventsCommand extends Command
{

    /**
     * @var string The name and signature of the console command.
     * @argument amount is optional, default value is 120
     * @argument year is optional
     * @argument month is optional
     * @argument day is optional
     */
    protected $signature = 'app:seed-events {--from?} {--to?} {--amount?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed events';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $amount = $this->option('amount');

        $this->info("Seeding {$amount} events");


    }
}
