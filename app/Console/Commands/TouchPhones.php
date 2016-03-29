<?php

namespace App\Console\Commands;

use App\Phone;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TouchPhones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'touch:phones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Touch phones';

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
        $now = Carbon::now();
        Phone::query()->update(['updated_at' => $now]);
        $this->info('Phone timestamps updated');
    }
}
