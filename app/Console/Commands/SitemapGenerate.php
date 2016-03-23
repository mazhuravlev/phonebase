<?php

namespace App\Console\Commands;

use App\Phone;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Watson\Sitemap\Facades\Sitemap;

class SitemapGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate sitemap';

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
        $counter = 1;
        $phones = Phone::chunk(10000, function (Collection $phones) use (&$counter) {
            Sitemap::addSitemap(env('APP_URL') . "/sitemap/sitemap_$counter.xml");
            foreach ($phones as $phone) {
                Sitemap::addTag(env('APP_URL') . '/' . $phone->number, $phone, 'daily', '0.8');
            }
            file_put_contents(public_path("sitemap/sitemap_$counter.xml"), Sitemap::xml());
            Sitemap::clearTags();
            $counter++;
        });
        file_put_contents(public_path('sitemap/sitemap.xml'), Sitemap::xmlIndex());
    }
}
