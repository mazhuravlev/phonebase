<?php

namespace App\Console\Commands;

use App\Phone;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LoadAvito extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:avito {--count} {--after-time=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load avito from grabber';

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
        /** @var PostgresConnection $db */
        $db = DB::connection('pgsql');
        $query = $db->query()->from('Sitemap')
            ->where('StatusId', 1)
            ->where('AddDate', '>', Carbon::createFromTimestamp($this->option('after-time')));
        if ($this->option('count')) {
            $this->info('Count is ' . $query->count());
            return;
        }
        $query->leftJoin('Items', 'Sitemap.Id', '=', 'Items.Id')
            ->select('Items.*')
            ->chunk(100, function ($items) {
            foreach ($items as $item) {
                if ($data = json_decode($item->Data)) {
                    if (!property_exists($data, 'phone')) {
                        continue;
                    }
                    /** @var Phone $phone */
                    $phone = Phone::firstOrCreate(['number' => self::formatPhone($data->phone)]);
                    if ($phone->wasRecentlyCreated) {
                        echo "Created new Phone: " . $phone->number . PHP_EOL;
                    } else {
                        echo "Using existing Phone: " . $phone->number . PHP_EOL;
                    }
                    try {
                        $phoneInfo = $phone->phoneInfos()->create([
                            'source_id' => 'avito.ru',
                            'id_source' => $data->id
                        ]);
                        $phoneInfo->data = [
                            'description' => $data->title . ' ' . $data->description,
                            'price' => property_exists($data, 'price') and property_exists($data->price, 'value') ?
                                    $data->price->value : null,
                        ];
                        $phoneInfo->save();
                        echo "Created new PhoneInfo: " . $data->id . PHP_EOL;
                    } catch (QueryException $e) {
                        if ('23000' === $e->getCode() and 1062 === $e->errorInfo[1]) {
                            echo "Dropped duplicate PhoneInfo: " . $data->id . PHP_EOL;
                            continue;
                        } else {
                            throw $e;
                        }
                    }
                }
            }
        });
    }

    private static function formatPhone($phone)
    {
        return preg_replace('/^8/', '7', preg_replace('/\D/', '', $phone));
    }

}
