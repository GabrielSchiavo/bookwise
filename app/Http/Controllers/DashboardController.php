<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use App\Models\Pessoa;
use App\Models\Retirada;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $listaLivros = Livros::all();
        $listaPessoas = Pessoa::all();
        $countLivros = $listaLivros->count();
        $countPessoas = $listaPessoas->count();

        $listaLivrosRetirados = Retirada::where([
            ['status', '>=', 1],
            ['status', '<=', 2],
        ]);

        if(request()->has('search')) {
            $listaLivrosRetirados = $listaLivrosRetirados->where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('pessoa', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('livro', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('dataDevolucao');

        } else {
            $listaLivrosRetirados = $listaLivrosRetirados->get()->sortBy('dataDevolucao');
        }

        $countRetirados = $listaLivrosRetirados->count();


        $dateNow = Carbon::now()->toDateString();
        $listaLivrosAtrasados = Retirada::where([
            ['dataDevolucao', '<', $dateNow],
            ['status', '!=', 3],
        ]);

        if(request()->has('search')) {
            $listaLivrosAtrasados = $listaLivrosAtrasados->where(function($query) {
                $query->where('pessoa', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('livro', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('id', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('dataDevolucao');

        } else {
            $listaLivrosAtrasados = $listaLivrosAtrasados->get()->sortBy('dataDevolucao');
        }

        $countAtrasados = $listaLivrosAtrasados->count();



        return view('dashboard', [
            'countLivros' => $countLivros,
            'countPessoas' => $countPessoas,
            'countRetirados' => $countRetirados,
            'countAtrasados' => $countAtrasados,
            'listaLivrosRetirados' => $listaLivrosRetirados,
            'listaLivrosAtrasados' => $listaLivrosAtrasados,
        ]);
    }
}
