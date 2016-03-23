<?php

namespace App\Console\Commands;

use App\Phone;
use App\PhoneInfo;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class GetInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:info {file} {--source=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get info from file';

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
        $data = file_get_contents(storage_path('input/' . $this->argument('file')));
        $json = json_decode($data);
        foreach ($json as $record) {
            $phone = Phone::firstOrCreate(['number' => intval($record->phone_id)]);
            $phoneInfo = new PhoneInfo();
            $phoneInfo->id_source = $record->id_source;
            $phoneInfo->data = ['description' => $record->description, 'price' => $record->price_string];
            if (property_exists($record, 'source_id')) {
                $phoneInfo->source_id = $record->source_id;
            } elseif ($this->option('source')) {
                $phoneInfo->source_id = $this->option('source');
            } else {
                throw new \ErrorException('no source and source not set');
            }
            $phoneInfo->setCreatedAt($record->created_at);
            $phoneInfo->phone()->associate($phone);
            try {
                $phoneInfo->save();
            } catch (QueryException $e) {
                if ('23000' === $e->getCode() and 1062 === $e->errorInfo[1]) {
                    continue;
                } else {
                    throw $e;
                }
            }
        }
    }
}
