<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            'id' => 1,
            'cover_image' => '81zN7udGRUL_1745877970.jpg',
            'title' => 'Duna',
            'author' => 'Franklin Patrick Herbert Jr.',
            'literary_gender_id' => 3,
            'literary_gender' => 'Aventura',
            'publisher' => 'Aleph',
            'year' => 2017,
            'isbn' => '978-8-57-657313-5',
            'status' => 'ATRASADO',
            'created_at' => '2025-04-28 19:06:10',
		    'updated_at' => '2025-04-28 19:09:58',
        ]);
        DB::table('books')->insert([
            'id' => 2,
            'cover_image' => '81hCVEC0ExL_1745878025.jpg',
            'title' => 'O Senhor dos Anéis: A Sociedade do Anel',
            'author' => 'J.R.R. Tolkien',
            'literary_gender_id' => 2,
            'literary_gender' => 'Fantasia',
            'publisher' => 'HarperCollins',
            'year' => 2019,
            'isbn' => '8-595084-75-0',
            'status' => 'RETIRADO',
            'created_at' => '2025-04-28 19:07:05',
		    'updated_at' => '2025-04-28 19:09:12',
        ]);
        DB::table('books')->insert([
            'id' => 3,
            'cover_image' => '91Bx5ilPELSY466_1745878083.jpg',
            'title' => 'Neuromancer',
            'author' => 'William Gibson',
            'literary_gender_id' => 1,
            'literary_gender' => 'Ficção',
            'publisher' => 'Aleph',
            'year' => 2016,
            'isbn' => '978-8-57-657300-5',
            'status' => 'RENOVADO',
            'created_at' => '2025-04-28 19:08:03',
		    'updated_at' => '2025-04-28 19:09:57',
        ]);
        DB::table('books')->insert([
            'id' => 4,
            'cover_image' => '51tAD6LyZLSY466_1745878127.jpg',
            'title' => 'Fahrenheit 451',
            'author' => 'Ray Bradbury',
            'literary_gender_id' => 1,
            'literary_gender' => 'Ficção',
            'publisher' => 'Biblioteca Azul',
            'year' => 2012,
            'isbn' => '8-525052-24-8',
            'status' => 'DISPONIVEL',
            'created_at' => '2025-04-28 19:08:47',
		    'updated_at' => '2025-04-28 19:08:47',
        ]);
    }
}
