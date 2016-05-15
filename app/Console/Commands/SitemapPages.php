<?php

namespace App\Console\Commands;

use App\Phone;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Watson\Sitemap\Facades\Sitemap;

class SitemapPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate pages sitemap';

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
        $sitemapFile = 'sitemap/sitemap_pages.xml.gz';
        $phoneCount = Phone::query()->count();
        $byPage = env('PHONES_BY_PAGE');
        $pagesCount = ceil($phoneCount / $byPage);
        printf('Dump sitemap for %d phones, %d by page, total %d pages' . PHP_EOL, $phoneCount, $byPage, $pagesCount);
        Sitemap::addSitemap(env('APP_URL') . "/$sitemapFile");
        for ($i = 1; $i <= $pagesCount; $i++) {
            Sitemap::addTag(env('APP_URL') . "/?page=$i", Carbon::now(), 'daily', '0.8');
        }
        file_put_contents(public_path($sitemapFile), gzencode(Sitemap::xml(), 5));
    }
}
