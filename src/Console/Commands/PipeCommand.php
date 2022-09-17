<?php

namespace Pipedrive\Console\Commands;

use Illuminate\Console\Command;

class PipeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pipedrive:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command install pipedrive in your app';

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
       $ask =  $this->ask('install pipedrive');
           dd($ask);
    }
}
