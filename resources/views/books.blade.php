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
@if(!empty($message))
    <div class="alert-container">
        <div class="alert alert-success">
            <p>{!! $message !!}</p>
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
            @foreach ($booksList as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>
                        @if ($book->cover_image == null)
                            <img class="td-img" src="/assets/images/default/coverNotAvailable.png" alt="Imagem capa do book genérica">
                            
                            @else
                                <img class="td-img" src="/storage/cover_images/{{ $book->cover_image }}" alt="Imagem capa do book">
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->literary_gender }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->year }}</td>
                    <td>
                        @if ($book->isbn == null)
                            N/A

                            @else
                                {{ $book->isbn }}
                        @endif
                    </td>
                    <td>
                        @if ($book->status == 1)
                            <p class="status status-yellow">Retirado</p>

                            @elseif ($book->status == 2)
                                <p class="status status-orange">Renovado</p>

                            @elseif ($book->status == 3)
                                <p class="status status-green">Disponível</p> 

                            @elseif ($book->status == 4)
                                <p class="status status-red">Atrasado</p>

                        @endif
                    </td>
                    <td>
                        <form action="/acervo/{{$book->id}}/excluir" method="POST" onsubmit="return confirm('Deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/acervo/{$book->id}/editar")}}" tabindex="0" class="edit" tabindex="0" title="Editar">
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