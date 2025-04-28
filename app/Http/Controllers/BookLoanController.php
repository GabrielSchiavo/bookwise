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
        if(request()->has('search')) {
             $bookLoanList = BookLoan::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('person', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('book', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('id');

        } else {
             $bookLoanList = BookLoan::all()->sortBy('id');
        }




        $dateNow = Carbon::now()->toDateString();
        $changeStatus = BookLoan::where([
            ['return_date', '<', $dateNow],
            ['status', '!=', 3],
        ])->update([
            'status' => 4,
        ]);

        $getIdLateBooks = BookLoan::where([
            ['return_date', '<', $dateNow],
            ['status', '!=', 3],
        ])->value('book_id');
        $changeBooksStatus = Book::where('id', '=', $getIdLateBooks)->update([
            'status' => 4,
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
            'booksList' => $booksList
        ]);
    }

    public function edit(Request $request)
    {
        $bookLoan = BookLoan::find($request->id);
        $personsList = Person::all()->sortBy('id');
        $booksList = Book::all()->sortBy('id');

        return view('register-books-loans', [
            'bookLoan' => $bookLoan,
            'personsList' => $personsList,
            'booksList' => $booksList
        ]);
    }

    public function delete(Request $request)
    {
        $bookLoan = BookLoan::find($request->id);
        $bookId = BookLoan::find($request->id)->value('book_id');

        $changeBookStatus = Book::where('id', '=', $bookId)->update([
            'status' => 3,
        ]);

        $bookLoan->delete();

        $request->$changeBookStatus;
        $request->session()->put('message', 'Retirada <span class="text-bold">ID ' . $bookLoan->id . '</span> excluida!');

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
            'after' => 'A <strong>Data de Devolução</strong> deve ser posterior a <strong>Data de BookLoan</strong>'
        ]);

        $getBookName = $request->book;
        $bookId = Book::where('title', '=', $getBookName)->value('id');
 
        if($request->status != null) {
            $changeBookStatus = Book::where('id', '=', $bookId)->update([
                'status' => $request->status,
            ]);
        }

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->id != null) {
            $bookLoan = BookLoan::find($request->id);
            $bookLoan->loan_date = $request->loan_date;
            $bookLoan->return_date = $request->return_date;
            $bookLoan->person = $request->person;
            $bookLoan->book = $request->book;
            $bookLoan->book_id = $bookId;
            $bookLoan->status = $request->status;
            $bookLoan->save();

            $request->$changeBookStatus;
            $request->session()->put('message', 'Retirada <span class="text-bold">ID ' . $bookLoan->id . '</span> atualizada!');
        } else {
            $bookLoan = BookLoan::create([
                'loan_date' => $request->loan_date,
                'return_date' => $request->return_date,
                'person' => $request->person,
                'book' => $request->book,
                'book_id' => $bookId,
                'status' => $request->status,
            ]);
            $request->$changeBookStatus;
            $request->session()->put('message', 'Retirada <span class="text-bold">ID ' . $bookLoan->id . '</span> criada!');
        }

        return redirect('/retiradas');
    }
}
