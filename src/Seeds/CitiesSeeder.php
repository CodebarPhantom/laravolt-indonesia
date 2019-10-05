<?php

namespace Laravolt\Indonesia\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $Csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/cities.csv';
        $header = ['id', 'province_id', 'name'];
        $data = $Csv->csv_to_array($file, $header);
        foreach ($data as $i => $city) {
            $data[$i]['name'] = \Str::title($city['name']);
        }

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('laravolt.indonesia.table_prefix').'cities')->insert($chunk->toArray());
        }
    }
}
