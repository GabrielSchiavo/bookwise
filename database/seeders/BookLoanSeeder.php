<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookLoanSeeder extends Seeder
{
    public function run()
    {
        DB::table('books_loans')->insert([
            'id' => 1,
            'loan_date' => '2025-04-28',
            'return_date' => '2025-05-05',
            'person' => 'José Silva',
            'book_id' => 2,
            'book' => 'O Senhor dos Anéis: A Sociedade do Anel',
            'status' => 1,
            'created_at' => '2025-04-28 19:09:12',
		    'updated_at' => '2025-04-28 19:09:12',
        ]);
        DB::table('books_loans')->insert([
            'id' => 2,
            'loan_date' => '2025-04-16',
            'return_date' => '2025-04-23',
            'person' => 'João Santos',
            'book_id' => 1,
            'book' => 'Duna',
            'status' => 4,
            'created_at' => '2025-04-28 19:09:34',
		    'updated_at' => '2025-04-28 19:09:58',
        ]);
        DB::table('books_loans')->insert([
            'id' => 3,
            'loan_date' => '2025-04-22',
            'return_date' => '2025-04-29',
            'person' => 'Maria Soares',
            'book_id' => 3,
            'book' => 'Neuromancer',
            'status' => 2,
            'created_at' => '2025-04-28 19:09:57',
		    'updated_at' => '2025-04-28 19:09:57',
        ]);
    }
}
