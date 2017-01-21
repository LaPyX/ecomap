<?php

namespace App\Console\Commands;

use App\News;
use Illuminate\Console\Command;

class RemoveNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all news from database';

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
        News::truncate();
        $this->info('News truncated');
    }
}
