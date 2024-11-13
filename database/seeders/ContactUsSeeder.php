<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_us')->insert([           
            [
                'name' => 'Beni Ozora',
                'email' => 'benedictus.radyan@great.sch.id',
                'message' => 'I have a question about my order.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Charlie Green',
                'email' => 'charlie@example.com',
                'message' => 'How long does shipping take?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'David White',
                'email' => 'david@example.com',
                'message' => 'I am facing issues with my payment.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
