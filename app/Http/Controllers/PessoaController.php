<?php
namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PessoaController extends Controller
{
    public function listaPessoas(Request $request)
    {
        if(request()->has('search')) {
            $listaPessoas = Pessoa::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('nome', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('telefone', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('email', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('id');

        } else {
            $listaPessoas = Pessoa::all()->sortBy('id');
        }

        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');

        return view('pessoas', [
            'listaPessoas' => $listaPessoas,
            'mensagem' => $mensagem
        ]);
    }

    public function cadastroPessoas()
    {
        return view('cadastro-pessoas');
    }

    public function editar(Request $request)
    {
        $pessoas = Pessoa::find($request->id);

        return view('cadastro-pessoas', [
            "pessoas" => $pessoas,
        ]);
    }

    public function excluir(Request $request)
    {
        $pessoas = Pessoa::find($request->id);
        $pessoas->delete();

        $request->session()->put('mensagem', 'Pessoa <span class="text-alert-emphasis">ID ' . $pessoas->id . '</span> excluida!');

        return redirect('/pessoas');
    }

    public function salvarPessoas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|min:1|max:100',
            'telefone' => 'required|unique:pessoas,telefone|min:11|max:15',
            'email' => 'required|unique:pessoas,email|email:rfc,dns',
        ], [
            'required' => 'O campo <span class="text-alert-emphasis">:attribute</span> é obrigatório',
            'unique' => 'Já existe uma Pessoa cadastrada com este <span class="text-alert-emphasis">:attribute</span>',
            'min' => 'O campo <span class="text-alert-emphasis">:attribute</span> precisa ter no mínimo :min caracteres',
            'max' => 'O campo <span class="text-alert-emphasis">:attribute</span> precisa ter no máximo :max caracteres',
            'email' => 'O <span class="text-alert-emphasis">:attribute</span> informado não é válido'
        ]);
 
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->id != null) {
            $pessoas = Pessoa::find($request->id);
            $pessoas->nome = $request->nome;
            $pessoas->telefone = $request->telefone;
            $pessoas->email = $request->email;
            $pessoas->save();

            $request->session()->put('mensagem', 'Pessoa <span class="text-alert-emphasis">ID ' . $pessoas->id . '</span> atualizada!');
        } else {
            $pessoas = Pessoa::create([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->email,
            ]);

            $request->session()->put('mensagem', 'Pessoa <span class="text-alert-emphasis">ID ' . $pessoas->id . '</span> criada!');
        }

        return redirect('/pessoas');
    }
}
