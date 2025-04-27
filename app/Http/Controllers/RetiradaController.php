<?php
namespace App\Http\Controllers;

use App\Models\Livros;
use App\Models\Pessoa;
use App\Models\Retirada;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RetiradaController extends Controller
{
    public function listaRetiradas(Request $request)
    {
        if(request()->has('search')) {
            $listaRetiradas = Retirada::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('pessoa', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('livro', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('id');

        } else {
            $listaRetiradas = Retirada::all()->sortBy('id');
        }




        $dateNow = Carbon::now()->toDateString();
        $changeStatus = Retirada::where([
            ['dataDevolucao', '<', $dateNow],
            ['status', '!=', 3],
        ])->update([
            'status' => 4,
        ]);

        $idLivrosAtrasados = Retirada::where([
            ['dataDevolucao', '<', $dateNow],
            ['status', '!=', 3],
        ])->value('livro_id');
        $changeStatusLivros = Livros::where('id', '=', $idLivrosAtrasados)->update([
            'status' => 4,
        ]);

        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');
        $request->$changeStatus;
        $request->$changeStatusLivros;

        return view('retiradas', [
            'listaRetiradas' => $listaRetiradas,
            'mensagem' => $mensagem,
        ]);
    }

    public function cadastroReservas()
    {
        $listaPessoas = Pessoa::all()->sortBy('id');
        $listaLivros = Livros::all()->sortBy('id');
        return view('cadastro-retiradas', [
            'listaPessoas' => $listaPessoas,
            'listaLivros' => $listaLivros
        ]);
    }

    public function editar(Request $request)
    {
        $retiradas = Retirada::find($request->id);
        $listaPessoas = Pessoa::all()->sortBy('id');
        $listaLivros = Livros::all()->sortBy('id');

        return view('cadastro-retiradas', [
            "retiradas" => $retiradas,
            'listaPessoas' => $listaPessoas,
            'listaLivros' => $listaLivros
        ]);
    }

    public function excluir(Request $request)
    {
        $retiradas = Retirada::find($request->id);
        $livro_id = Retirada::find($request->id)->value('livro_id');

        $atualiza_status_livro = Livros::where('id', '=', $livro_id)->update([
            'status' => 3,
        ]);

        $retiradas->delete();

        $request->$atualiza_status_livro;
        $request->session()->put('mensagem', 'Retirada <span class="text-alert-emphasis">ID ' . $retiradas->id . '</span> excluida!');

        return redirect('/retiradas');
    }

    public function salvarReservas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataRetirada' => 'required|date',
            'dataDevolucao' => 'required|date|after:dataRetirada',
            'pessoa' => 'required',
            'livro' => 'required',
            'status' => 'required',
        ], [
            'required' => 'O campo <span class="text-alert-emphasis"><span class="text-alert-emphasis">:attribute</span></span> é obrigatório',
            'after' => 'A <strong>Data de Devolução</strong> deve ser posterior a <strong>Data de Retirada</strong>'
        ]);

        $livroNome = $request->livro;
        $livroId = Livros::where('titulo', '=', $livroNome)->value('id');
 
        if($request->status != null) {
            $atualiza_status_livro = Livros::where('id', '=', $livroId)->update([
                'status' => $request->status,
            ]);
        }

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->id != null) {
            $retiradas = Retirada::find($request->id);
            $retiradas->dataRetirada = $request->dataRetirada;
            $retiradas->dataDevolucao = $request->dataDevolucao;
            $retiradas->pessoa = $request->pessoa;
            $retiradas->livro = $request->livro;
            $retiradas->livro_id = $livroId;
            $retiradas->status = $request->status;
            $retiradas->save();

            $request->$atualiza_status_livro;
            $request->session()->put('mensagem', 'Retirada <span class="text-alert-emphasis">ID ' . $retiradas->id . '</span> atualizada!');
        } else {
            $retiradas = Retirada::create([
                'dataRetirada' => $request->dataRetirada,
                'dataDevolucao' => $request->dataDevolucao,
                'pessoa' => $request->pessoa,
                'livro' => $request->livro,
                'livro_id' => $livroId,
                'status' => $request->status,
            ]);
            $request->$atualiza_status_livro;
            $request->session()->put('mensagem', 'Retirada <span class="text-alert-emphasis">ID ' . $retiradas->id . '</span> criada!');
        }

        return redirect('/retiradas');
    }
}
