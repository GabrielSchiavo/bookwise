<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    public function run()
    {
        DB::table('persons')->insert([
            'id' => 1,
            'name_last_name' => 'José Silva',
            'phone' => '(55) 55555-5555',
            'email' => 'teste@teste.com',
            'created_at' => '2025-04-28 18:59:23',
		    'updated_at' => '2025-04-28 18:59:23',
        ]);
        DB::table('persons')->insert([
            'id' => 2,
            'name_last_name' => 'João Santos',
            'phone' => '(22) 22222-2222',
            'email' => 'teste2@teste2.com',
            'created_at' => '2025-04-28 19:03:51',
		    'updated_at' => '2025-04-28 19:03:51',
        ]);
        DB::table('persons')->insert([
            'id' => 3,
            'name_last_name' => 'Maria Soares',
            'phone' => '(32) 33333-3333',
            'email' => 'teste3@teste3.com',
            'created_at' => '2025-04-28 19:04:15',
		    'updated_at' => '2025-04-28 19:04:15',
        ]);
    }
}
