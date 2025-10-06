<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Area as Wilayah;

class ImportWilayah extends Command
{
    protected $signature = 'import:wilayah';
    protected $description = 'Import data wilayah dari JSON ke database';

    public function handle()
    {
        $path = storage_path('app\public\kodepos.json');
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            Wilayah::create([
                'province'    => $item['province'],
                'city'        => $item['city'],
                'district'    => $item['district'],
                'subdistrict' => $item['subdistrict'],
                'postal_code' => $item['postal_code'],
            ]);
        }

        $this->info("Import selesai! Total: " . count($data));
    }
}
