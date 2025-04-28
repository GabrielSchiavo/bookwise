<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LiteraryGenresSeeder extends Seeder
{
    public function run()
    {
        DB::table('literary_genres')->insert([
            'id' => 1,
            'name' => 'Ficção',
            'created_at' => '2025-04-28 18:55:53',
		    'updated_at' => '2025-04-28 18:55:53',
        ]);
        DB::table('literary_genres')->insert([
            'id' => 2,
            'name' => 'Fantasia',
            'created_at' => '2025-04-28 18:56:02',
		    'updated_at' => '2025-04-28 18:56:02',
        ]);
        DB::table('literary_genres')->insert([
            'id' => 3,
            'name' => 'Aventura',
            'created_at' => '2025-04-28 18:58:21',
		    'updated_at' => '2025-04-28 18:58:21',
        ]);
    }
}
