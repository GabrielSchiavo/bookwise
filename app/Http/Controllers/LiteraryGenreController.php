<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\LiteraryGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LiteraryGenreController extends Controller
{
    public function listData(Request $request)
    {
        if(request()->has('search')) {
            $listLiteraryGenres = LiteraryGenre::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('name', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('return_date');

        } else {
            $listLiteraryGenres = LiteraryGenre::all()->sortBy('id');
        }

        $message = $request->session()->get('message');
        $request->session()->remove('message');

        return view('literary-genres', [
            'listLiteraryGenres' => $listLiteraryGenres,
            'message' => $message
        ]);
    }

    public function formData()
    {
        return view('register-literary-genres');
    }

    public function edit(Request $request)
    {
        $literaryGenre = LiteraryGenre::find($request->id);

        return view('register-literary-genres', [
            'literaryGenre' => $literaryGenre,
        ]);
    }

    public function delete(Request $request)
    {
        $literaryGenre = LiteraryGenre::find($request->id);
        $bookLiteraryGenre = Book::where('literary_gender_id', '=', $request->id);

        if($bookLiteraryGenre != null) {
            $request->session()->put('message', 'Gênero <span class="text-bold">ID ' . $literaryGenre->id . '</span> não é possível excluir!');
        } else {
            $literaryGenre->delete();
            $request->session()->put('message', 'Gênero <span class="text-bold">ID ' . $literaryGenre->id . '</span> excluido!');
        }

        return redirect('/generos-literarios');
    }

    public function saveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'min:1',
                'max:250',
                Rule::unique('literary_genres')->ignore($request->id),
            ],
        ], [
            'required' => 'O campo <span class="text-bold">:attribute</span> é obrigatório',
            'unique' => 'Já existe um Genêreo Literário cadastrado com este <span class="text-bold">:attribute</span>',
            'min' => 'O campo <span class="text-bold">:attribute</span> precisa ter no mínimo :min caracteres',
            'max' => 'O campo <span class="text-bold">:attribute</span> precisa ter no máximo :max caracteres'
        ]);
 
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->id != null) {
            $literaryGenre = LiteraryGenre::find($request->id);
            $bookLiteraryGenre = Book::where('literary_gender_id', '=', $request->id);
            $literaryGenre->name = $request->name;
            
            if($bookLiteraryGenre != null) {
                $literaryGenre->save();

                Book::where('literary_gender_id', '=', $request->id)->update([
                    'literary_gender' => $literaryGenre->name,
                ]);
                
                $request->session()->put('message', 'Gênero <span class="text-bold">ID ' . $literaryGenre->id . '</span> atualizado!');
            } else {
                $literaryGenre->save();
                $request->session()->put('message', 'Gênero <span class="text-bold">ID ' . $literaryGenre->id . '</span> atualizado!');
            }

        } else {
            $literaryGenre = LiteraryGenre::create([
                'name' => $request->name
            ]);

            $request->session()->put('message', 'Gênero <span class="text-bold">ID ' . $literaryGenre->id . '</span> criado!');
        }

        return redirect('/generos-literarios');
    }
}
