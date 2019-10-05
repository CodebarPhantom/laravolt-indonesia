<?php

namespace Laravolt\Indonesia\Seeds;

use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    public function run()
    {
        $Csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/provinces.csv';
        $header = ['id', 'name'];
        $data = $Csv->csv_to_array($file, $header);
        foreach ($data as $i => $province) {
            $data[$i]['name'] = $province['name'] == 'DKI JAKARTA' ? 'DKI Jakarta'
                                : ($province['name'] == 'DI YOGYAKARTA' ? 'D.I. Yogyakarta'
                                : \Str::title($province['name']));
        }

        \DB::table(config('laravolt.indonesia.table_prefix').'provinces')->insert($data);
    }
}
