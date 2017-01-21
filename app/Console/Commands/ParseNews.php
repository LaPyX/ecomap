<?php

namespace App\Console\Commands;

use App\News;
use Illuminate\Console\Command;
use DiDom\Document;

class ParseNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse news from main website';

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
        $path = 'http://eco.onf.ru/news';
        $page = '?page=';

        $document   = new Document($path, $isFile = true);
        $entryBlock = '.views-row';

        $items = $document->find($entryBlock);
        foreach ($items as $item) {
            $entryMeta = $item->find('.views-field-title a')[0];
            $entryName = $entryMeta->text();
            $entryLink = $entryMeta->attr('href');

            $news = News::where('name', $entryName)->first();
            if (isset($news) && $news->id) {
                continue;
            }

            $text      = '';
            $entryBody = new Document($entryLink, $isFile = true);

            if ($entryBody->has('.field-name-field-image .field-item')) {
                $text .= $entryBody->find('.field-name-field-image .field-item')[0]->text();
            }

            if ($entryBody->has('.field-name-body .field-item')) {
                $text .= $entryBody->find('.field-name-body .field-item')[0];
            }

            $photos = $entryBody->find('.field-name-field-photos .field-item a');
            foreach ($photos as $photo) {
                $url   = $photo->attr('href');
                $text .= '<img src="' . $url . '">';
            }

            $news = new News();

            $news->name   = $entryName;
            $news->text   = $text;
            $news->status = 1;

            $news->save();
        }
    }
}
