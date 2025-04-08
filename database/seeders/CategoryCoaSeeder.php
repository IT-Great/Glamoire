<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoryCoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'ASET LANCAR',
            'PAJAK DIBAYAR DIMUKA',
            'PERSEDIAAN',
            'ASET TIDAK LANCAR',
            'KEWAJIBAN LANCAR',
            'KEWAJIBAN JANGKA PANJANG',
            'EKUITAS',
            'PENDAPATAN',
            'BEBAN POKOK',
            'BEBAN PENJUALAN',
            'BEBAN UMUM & ADMINISTRASI',
            'PENDAPATAN (BEBAN) LAIN-LAIN',         
        ];

        foreach ($categories as $category) {
            DB::table('category_coas')->insert([
                'category_name' => $category,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
