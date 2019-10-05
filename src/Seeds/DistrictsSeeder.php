<?php

namespace Laravolt\Indonesia\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsSeeder extends Seeder
{
    public function run()
    {
        $Csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/districts.csv';
        $header = ['id', 'city_id', 'name'];
        $data = $Csv->csv_to_array($file, $header);
        foreach ($data as $i => $district) {
            $data[$i]['name'] = \Str::title($district['name']);
        }

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('laravolt.indonesia.table_prefix').'districts')->insert($chunk->toArray());
        }
    }
}
