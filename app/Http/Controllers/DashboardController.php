<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Person;
use App\Models\BookLoan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function listData()
    {
        $booksList = Book::all();
        $personsList = Person::all();
        $bookCount = $booksList->count();
        $personsCount = $personsList->count();

        $loanBooksList = BookLoan::where(function ($query) {
            $query->where('status', '=', 'RETIRADO')->orWhere('status', '=', 'RENOVADO');
        });

        if (request()->has('search')) {
            $loanBooksList = $loanBooksList->where(function ($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('person', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('book', 'ILIKE', '%' . request()->get('search', '') . '%');
            })->get()->sortBy('return_date');
        } else {
            $loanBooksList = $loanBooksList->get()->sortBy('return_date');
        }

        $loanBooksCount = $loanBooksList->count();


        $dateNow = Carbon::now()->toDateString();
        $lateBooksList = BookLoan::where([
            ['return_date', '<', $dateNow],
            ['status', '!=', 'DISPONIVEL'],
        ]);

        if (request()->has('search')) {
            $lateBooksList = $lateBooksList->where(function ($query) {
                $query->where('person', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('book', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('id', 'ILIKE', '%' . request()->get('search', '') . '%');
            })->get()->sortBy('return_date');
        } else {
            $lateBooksList = $lateBooksList->get()->sortBy('return_date');
        }

        $lateBooksCount = $lateBooksList->count();



        return view('dashboard', [
            'bookCount' => $bookCount,
            'personsCount' => $personsCount,
            'loanBooksCount' => $loanBooksCount,
            'lateBooksCount' => $lateBooksCount,
            'loanBooksList' => $loanBooksList,
            'lateBooksList' => $lateBooksList,
        ]);
    }
}
