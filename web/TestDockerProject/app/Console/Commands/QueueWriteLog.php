<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// job
use App\Jobs\WriteLog;

class QueueWriteLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:queue-write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A test command to write log by queue.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        WriteLog::dispatch();
        $this->info('Log has been written successfully by queue.');
    }
}
