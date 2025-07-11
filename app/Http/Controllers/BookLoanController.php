<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Person;
use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookLoanController extends Controller
{
    public function listData(Request $request)
    {
        if (request()->has('search')) {
            $bookLoanList = BookLoan::where(function ($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('person', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('book', 'ILIKE', '%' . request()->get('search', '') . '%');
            })->get()->sortBy('id');
        } else {
            $bookLoanList = BookLoan::all()->sortBy('id');
        }

        $dateNow = Carbon::now()->toDateString();
        $changeStatus = BookLoan::where(function ($query) use ($dateNow) {
            $query->where('return_date', '<', $dateNow);
        })->update([
            'status' => 'ATRASADO',
        ]);

        $getIdLateBooks = BookLoan::where(function ($query) use ($dateNow) {
            $query->where('return_date', '<', $dateNow);
        })->value('book_id');
        $changeBooksStatus = Book::where('id', '=', $getIdLateBooks)->update([
            'status' => 'ATRASADO',
        ]);

        $message = $request->session()->get('message');
        $request->session()->remove('message');
        $request->$changeStatus;
        $request->$changeBooksStatus;

        return view('books-loans', [
            'bookLoanList' =>  $bookLoanList,
            'message' => $message,
        ]);
    }

    public function formData()
    {
        $personsList = Person::all()->sortBy('id');
        $booksList = Book::all()->sortBy('id');

        return view('register-books-loans', [
            'personsList' => $personsList,
            'booksList' => $booksList,
        ]);
    }

    public function edit(Request $request)
    {
        $bookLoan = BookLoan::find($request->id);
        $personsList = Person::all()->sortBy('id');
        $booksList = Book::all()->sortBy('id');

        $selectedBook = collect($booksList)->firstWhere('title', $bookLoan->book);

        return view('register-books-loans', [
            'bookLoan' => $bookLoan,
            'personsList' => $personsList,
            'booksList' => $booksList,

            'selectedBook' => $selectedBook,
        ]);
    }

    public function delete(Request $request)
    {
        $bookLoan = BookLoan::find($request->id);
        $bookId = BookLoan::find($request->id)->value('book_id');

        $changeBookStatus = Book::where('id', '=', $bookId)->update([
            'status' => 'DISPONIVEL',
        ]);

        $bookLoan->delete();

        $request->$changeBookStatus;
        $request->session()->put('message', 'Retirada de <span class="text-bold">ID ' . $bookLoan->id . '</span> excluída com sucesso!');

        return redirect('/retiradas');
    }

    public function saveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after:loan_date',
            'book' => 'required',
            'person' => 'required',
            'status' => 'required',
        ], [
            'required' => 'O campo <span class="text-bold"><span class="text-bold">:attribute</span></span> é obrigatório',
            'after' => 'A <strong>Data de Devolução</strong> deve ser posterior a <strong>Data de Retirada</strong>'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $getBookName = $request->book;
        $getPersonName = $request->person;

        $bookId = Book::where('title', '=', $getBookName)->value('id');
        $personId = Person::where('name_last_name', '=', $getPersonName)->value('id');

        if ($request->status != null) {
            $changeBookStatus = Book::where('id', '=', $bookId)->update([
                'status' => $request->status,
            ]);
        }

        if ($request->id != null) {
            $booksList = Book::all()->sortBy('id');
            $bookLoan = BookLoan::find($request->id);

            $selectedBook = collect($booksList)->firstWhere('title', $bookLoan->book);

            $bookLoan->loan_date = $request->loan_date;
            $bookLoan->return_date = $request->return_date;
            $bookLoan->person_id = $personId;
            $bookLoan->person = $request->person;
            $bookLoan->book = $request->book;
            $bookLoan->book_id = $bookId;
            $bookLoan->status = $request->status;
            $bookLoan->save();


            if ($selectedBook->id != $bookId) {
                $updateStatusBookLoan = Book::where('id', '=', $selectedBook->id)->update([
                    'status' => 'DISPONIVEL',
                ]);
                $request->$updateStatusBookLoan;
            }

            $request->$changeBookStatus;
            $request->session()->put('message', 'Retirada de <span class="text-bold">ID ' . $bookLoan->id . '</span> atualizada com sucesso!');
        } else {
            $bookLoan = BookLoan::create([
                'loan_date' => $request->loan_date,
                'return_date' => $request->return_date,
                'person_id' => $personId,
                'person' => $request->person,
                'book_id' => $bookId,
                'book' => $request->book,
                'status' => $request->status,
            ]);
            $request->$changeBookStatus;
            $request->session()->put('message', 'Retirada de <span class="text-bold">ID ' . $bookLoan->id . '</span> criada com sucesso!');
        }

        return redirect('/retiradas');
    }
}
