<?php

namespace App\Http\Controllers;

use App\Models\LiteraryGenre;
use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function listData(Request $request)
    {
        if (request()->has('search')) {
            $booksList = Book::where(function ($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('title', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('series', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('volume', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('author', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('literary_gender', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('publisher', 'ILIKE', '%' . request()->get('search', '') . '%')
                    ->orWhere('year', 'ILIKE', '%' . request()->get('search', '') . '%');
            })->get()->sortBy('id');
        } else {
            $booksList = Book::all()->sortBy('id');
        }

        $message = $request->session()->get('message');
        $request->session()->remove('message');

        return view('books', [
            'booksList' => $booksList,
            'message' => $message,
        ]);
    }

    public function formData()
    {
        $listLiteraryGenres = LiteraryGenre::all()->sortBy('id');

        return view('register-books', [
            'listLiteraryGenres' => $listLiteraryGenres,
        ]);
    }

    public function edit(Request $request)
    {
        $book = Book::find($request->id);
        $listLiteraryGenres = LiteraryGenre::all()->sortBy('id');
        $saveCoverImage =  Book::where('id', '=', $book->id)->value('cover_image');

        return view('register-books', [
            'book' => $book,
            'listLiteraryGenres' => $listLiteraryGenres,
            'saveCoverImage' => $saveCoverImage,
        ]);
    }

    public function delete(Request $request)
    {
        $book = Book::find($request->id);
        $bookLoan = BookLoan::where('book_id', '=', $request->id)->count();

        if($bookLoan != 0) {
            return Redirect::back()->withInput()->withErrors('Não é possível excluir o Livro de <span class="text-bold">ID ' . $book->id . '</span>, pois ele está vinculado a uma reserva.');
        } else {
            $book->delete();
            $request->session()->put('message', 'Livro de <span class="text-bold">ID ' . $book->id . '</span> excluído com sucesso!');
        }

        return redirect('/acervo');
    }

    public function saveData(Request $request)
    {
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'literary_gender' => 'required',
            'isbn' => 'nullable|regex:/^(?=(?:[^0-9]*[0-9]){10}(?:(?:[^0-9]*[0-9]){3})?$)[\\d-]+$/|max:17', // ISBN-10
            'title' => 'required|min:1|max:250',
            'series' => 'nullable|min:1|max:250',
            'volume' => 'nullable|doesnt_start_with:-',
            'author' => 'required|min:1|max:250',
            'publisher' => 'required|min:1|max:250',
            'year' => 'required|size:4|doesnt_start_with:-',
            'cover_image' => 'image|nullable',
        ], [
            'required' => 'O campo <span class="text-bold">:attribute</span> é obrigatório',
            'min' => 'O campo <span class="text-bold">:attribute</span> precisa ter no mínimo :min caracteres',
            'max' => 'O campo <span class="text-bold">:attribute</span> precisa ter no máximo :max caracteres',
            'size' => 'O campo <span class="text-bold">:attribute</span> deve conter 4 dígitos',
            'doesnt_start_with' => 'O campo <span class="text-bold">:attribute</span> não pode ser negativo',
            'regex' => 'O formato do código <span class="text-bold">:attribute</span> é inválido. Selecione o formato correto do código :attribute',
            'image' => 'O arquivo no campo <span class="text-bold">:attribute</span> deve ser uma imagem'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $literaryGenderName = $request->literary_gender;
        $literaryGenderId = LiteraryGenre::where('name', '=', $literaryGenderName)->value('id');


        if ($request->hasFile('cover_image')) {
            // Obtém o nome de arquivo com a extensão
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Obtém apenas o nome do arquivo
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Obtém apenas a extenção
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Nome do arquivo para armazenar
            $bookCoverImage = $fileName . '_' . time() . '.' . $extension;

            // Upload da Imagem
            $path = $request->file('cover_image')->storeAs('public/upload/cover_images', $bookCoverImage);
        } else {
            $book = Book::find($request->id);
            $bookCoverImage = $book?->cover_image;
        }

        if ($request->id != null) {
            $book = Book::find($request->id);
            $bookLoan = BookLoan::where('book_id', '=', $request->id);
            $book->literary_gender = $request->literary_gender;
            $book->literary_gender_id = $literaryGenderId;
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->series = $request->series;
            $book->volume = $request->volume;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->year = $request->year;
            $book->cover_image = $bookCoverImage;

            if($bookLoan != null) {
                $book->save();

                BookLoan::where('book_id', '=', $request->id)->update([
                    'book' => $book->title,
                ]);
                
                $request->session()->put('message', 'Livro de <span class="text-bold">ID ' . $book->id . '</span> atualizado com sucesso!');
            } else {
                $book->save();
                $request->session()->put('message', 'Livro de <span class="text-bold">ID ' . $book->id . '</span> atualizado com sucesso!');
            }

        } else {
            $literaryGenderName = $request->literary_gender;
            $literaryGenderId = LiteraryGenre::where('name', '=', $literaryGenderName)->value('id');

            if ($request->status == null) {
                $statusLivro = 'DISPONIVEL';
            }

            $book = Book::create([
                'literary_gender' => $request->literary_gender,
                'literary_gender_id' => $literaryGenderId,
                'isbn' => $request->isbn,
                'title' => $request->title,
                'series' => $request->series,
                'volume' => $request->volume,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
                'cover_image' => $bookCoverImage,
                'status' => $statusLivro,
            ]);

            $request->session()->put('message', 'Livro de <span class="text-bold">ID ' . $book->id . '</span> criado com sucesso!');
        }

        return redirect('/acervo');
    }
}
