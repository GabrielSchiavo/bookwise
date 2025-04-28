<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET session_replication_role=replica');

        $this->call([
            PersonSeeder::class,

            BookLoanSeeder::class,

            BookSeeder::class,

            LiteraryGenresSeeder::class,
        ]);

        DB::statement('SET session_replication_role = origin');
    }
}
