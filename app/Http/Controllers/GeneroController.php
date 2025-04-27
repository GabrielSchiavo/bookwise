<?php
namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GeneroController extends Controller
{
    public function listaGeneros(Request $request)
    {
        if(request()->has('search')) {
            $listaGeneros = Genero::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('nome', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('dataDevolucao');

        } else {
            $listaGeneros = Genero::all()->sortBy('id');
        }

        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');

        return view('generos-literarios', [
            'listaGeneros' => $listaGeneros,
            'mensagem' => $mensagem
        ]);
    }

    public function cadastroGenero()
    {
        return view('cadastro-generos-literarios');
    }

    public function editar(Request $request)
    {
        $generos = Genero::find($request->id);

        return view('cadastro-generos-literarios', [
            "generos" => $generos,
        ]);
    }

    public function excluir(Request $request)
    {
        $generos = Genero::find($request->id);
        $generos->delete();

        $request->session()->put('mensagem', 'Gênero <span class="text-alert-emphasis">ID ' . $generos->id . '</span> excluido!');

        return redirect('/generos-literarios');
    }

    public function salvarGenero(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|unique:generos,nome|min:1|max:250'
        ], [
            'required' => 'O campo <span class="text-alert-emphasis">:attribute</span> é obrigatório',
            'unique' => 'Já existe um Genêreo Literário cadastrado com este <span class="text-alert-emphasis">:attribute</span>',
            'min' => 'O campo <span class="text-alert-emphasis">:attribute</span> precisa ter no mínimo :min caracteres',
            'max' => 'O campo <span class="text-alert-emphasis">:attribute</span> precisa ter no máximo :max caracteres'
        ]);
 
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->id != null) {
            $generos = Genero::find($request->id);
            $generos->nome = $request->nome;
            $generos->save();

            $request->session()->put('mensagem', 'Gênero <span class="text-alert-emphasis">ID ' . $generos->id . '</span> atualizado!');
        } else {
            $generos = Genero::create([
                'nome' => $request->nome
            ]);

            $request->session()->put('mensagem', 'Gênero <span class="text-alert-emphasis">ID ' . $generos->id . '</span> criado!');
        }

        return redirect('/generos-literarios');
    }
}
