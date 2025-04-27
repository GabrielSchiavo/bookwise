@extends('layout')

@section('tituloGuia')
    BookWise - Acervo
@endsection

@section('optionSideMenu03')
active
@endsection

@section('searchAction')
/acervo
@endsection

@section('conteudo')
@if(!empty($mensagem))
    <div class="alert-container">
        <div class="alert alert-success">
            <p>{!! $mensagem !!}</p>
        </div>
    </div>
@endif

<div class="data-container">
    <div class="data-content">
        <div class="head">
            <h3>Acervo</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th>ID</th>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Gênero Literário</th>
                    <th>Editora</th>
                    <th>Ano</th>
                    <th>ISBN</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-content-center">
            @foreach ($listaLivros as $livros)
                <tr>
                    <td>{{ $livros->id }}</td>
                    <td>
                        @if ($livros->imgCapa == null)
                            <img class="td-img" src="/assets/images/default/coverNotAvailable.png" alt="Imagem capa do livro genérica">
                            
                            @else
                                <img class="td-img" src="/storage/imgCapa/{{ $livros->imgCapa }}" alt="Imagem capa do livro">
                        @endif
                    </td>
                    <td>{{ $livros->titulo }}</td>
                    <td>{{ $livros->autor }}</td>
                    <td>{{ $livros->genero }}</td>
                    <td>{{ $livros->editora }}</td>
                    <td>{{ $livros->ano }}</td>
                    <td>
                        @if ($livros->isbn == null)
                            N/A

                            @else
                                {{ $livros->isbn }}
                        @endif
                    </td>
                    <td>
                        @if ($livros->status == 1)
                            <p class="status status-yellow">Retirado</p>

                            @elseif ($livros->status == 2)
                                <p class="status status-orange">Renovado</p>

                            @elseif ($livros->status == 3)
                                <p class="status status-green">Disponível</p> 

                            @elseif ($livros->status == 4)
                                <p class="status status-red">Atrasado</p>

                        @endif
                    </td>
                    <td>
                        <form action="/acervo/{{$livros->id}}/excluir" method="POST" onsubmit="return confirm('Deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/acervo/{$livros->id}/editar")}}" tabindex="0" class="editar" tabindex="0" title="Editar">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="/assets/images/icons/icon-pencil.svg" alt="Ícone Lápis">
                                </a>
                                <button class="btn-actions btn-action-delete" type="submit" tabindex="0" title="Excluir">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="/assets/images/icons/icon-trash.svg" alt="Ícone Lixeira">
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection