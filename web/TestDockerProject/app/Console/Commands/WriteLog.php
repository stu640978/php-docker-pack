<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class WriteLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A test command to write log to the file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::debug('This is a debug message by log:write command.');
        $this->info('Log has been written successfully.');
    }
}
