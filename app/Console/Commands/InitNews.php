<?php

namespace App\Console\Commands;

use App\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:init {page : Total number of pages to fetch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init import of news from main website';

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
        for ($i = $this->argument('page'); $i > 0; $i++) {
            Artisan::call('news:parse', [
                'page' => $i
            ]);
        }
    }
}
