<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LivrosController extends Controller
{
    public function listaLivros(Request $request)
    {
        if(request()->has('search')) {
            $listaLivros = Livros::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('titulo', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('autor', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('genero', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('editora', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('ano', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('id');

        } else {
            $listaLivros = Livros::all()->sortBy('id');
        }

        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');

        return view('livros', [
            'listaLivros' => $listaLivros,
            'mensagem' => $mensagem,
        ]);
    }

    public function cadastroLivros()
    {
        $listaGeneros = Genero::all()->sortBy('id');

        return view('cadastro-livros', [
            'listaGeneros' => $listaGeneros,
        ]);
    }

    public function editar(Request $request)
    {
        $livros = Livros::find($request->id);
        $listaGeneros = Genero::all()->sortBy('id');
        $imgCapaSave =  Livros::where('id', '=', $livros->id)->value('imgCapa');

        return view('cadastro-livros', [
            "livros" => $livros,
            'listaGeneros' => $listaGeneros,
            'imgCapaSave' => $imgCapaSave,
        ]);
    }

    public function excluir(Request $request)
    {
        $livros = Livros::find($request->id);
        $livros->delete();

        $request->session()->put('mensagem', 'Livro <span class="text-alert-emphasis">ID ' . $livros->id . '</span> excluido!');

        return redirect('/acervo');
    }

    public function salvarLivros(Request $request)
    {
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'genero' => 'required',
            'isbn' => 'nullable|regex:/^(?=(?:[^0-9]*[0-9]){10}(?:(?:[^0-9]*[0-9]){3})?$)[\\d-]+$/|max:17', // ISBN-10
            'titulo' => 'required|min:1|max:250',
            'autor' => 'required|min:1|max:250',
            'editora' => 'required|min:1|max:250',
            'ano' => 'required|size:4|doesnt_start_with:-',
            'imgCapa' => 'image|nullable',
        ], [
            'required' => 'O campo <span class="text-alert-emphasis">:attribute</span> é obrigatório',
            'min' => 'O campo <span class="text-alert-emphasis">:attribute</span> precisa ter no mínimo :min caracteres',
            'max' => 'O campo <span class="text-alert-emphasis">:attribute</span> precisa ter no máximo :max caracteres',
            'size' => 'O campo <span class="text-alert-emphasis">:attribute</span> deve conter 4 dígitos',
            'doesnt_start_with' => 'O campo <span class="text-alert-emphasis">:attribute</span> não pode ser negativo',
            'regex' => 'O formato do <strong>código ISBN</strong> é inválido. Selecione o formato correto do código ISBN',
            'image' => 'O arquivo no campo <stron>Capa</stron> deve ser uma imagem'
        ]);

        $generoNome = $request->genero;
        $generoId = Genero::where('nome', '=', $generoNome)->value('id');

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->hasFile('imgCapa')) {
            // Obtém o nome de arquivo com a extensão
            $nomeArquivoComExt = $request->file('imgCapa')->getClientOriginalName();

            // Obtém apenas o nome do arquivo
            $nomeArquivo = pathinfo($nomeArquivoComExt, PATHINFO_FILENAME);

            // Obtém apenas a extenção
            $extensao = $request->file('imgCapa')->getClientOriginalExtension();

            // Nome do arquivo para armazenar
            $imgCapa = $nomeArquivo . '_' . time() . '.' . $extensao;

            // Upload da Imagem
            $path = $request->file('imgCapa')->storeAs('public/imgCapa', $imgCapa);
        } else {
            $livros = Livros::find($request->id);
            $imgCapa = $livros?->imgCapa;
        }

        if ($request->id != null) {
            $livros = Livros::find($request->id);
            $livros->genero = $request->genero;
            $livros->genero_id = $generoId;
            $livros->isbn = $request->isbn;
            $livros->titulo = $request->titulo;
            $livros->autor = $request->autor;
            $livros->editora = $request->editora;
            $livros->ano = $request->ano;
            $livros->imgCapa = $imgCapa;

            $livros->save();

            $request->session()->put('mensagem', 'Livro <span class="text-alert-emphasis">ID ' . $livros->id . '</span> atualizado!');
        } else {
            // $null = 'N/A';

            $generoNome = $request->genero;
            $generoId = Genero::where('nome', '=', $generoNome)->value('id');

            if ($request->status == null) {
                $statusLivro = 3;
            }

            $livros = Livros::create([
                'genero' => $request->genero,
                'genero_id' => $generoId,
                'isbn' => $request->isbn,
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'editora' => $request->editora,
                'ano' => $request->ano,
                'imgCapa' => $imgCapa,
                'status' => $statusLivro,
            ]);

            $request->session()->put('mensagem', 'Livro <span class="text-alert-emphasis">ID ' . $livros->id . '</span> criado!');
        }

        return redirect('/acervo');
    }
}
