<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Mobil Baru',
                'description' => 'Mobil brand new',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobil Bekas',
                'description' => 'Mobil bekas atau second',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}