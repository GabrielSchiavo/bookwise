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
            <h3 tabindex="0">Acervo</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th tabindex="0">ID</th>
                    <th tabindex="0">Capa</th>
                    <th tabindex="0">Título</th>
                    <th tabindex="0">Autor</th>
                    <th tabindex="0">Gênero Literário</th>
                    <th tabindex="0">Editora</th>
                    <th tabindex="0">Ano</th>
                    <th tabindex="0">ISBN</th>
                    <th tabindex="0">Status</th>
                    <th tabindex="0">Ações</th>
                </tr>
            </thead>
            <tbody class="table-content-center">
            @foreach ($booksList as $book)
                <tr>
                    <td tabindex="0">{{ $book->id }}</td>
                    <td tabindex="0">
                        @if ($book->cover_image == null)
                            <img class="td-img" src="{{ Vite::asset('resources/assets/images/default/cover-not-available.png') }}" alt="Imagem capa do book genérica">
                            
                            @else
                                <img class="td-img" src="/storage/upload/cover_images/{{ $book->cover_image }}" onerror="this.src='{{ Vite::asset('resources/assets/images/default/cover-not-available.png') }}'" alt="Imagem capa do book">
                        @endif
                    </td>
                    <td tabindex="0">{{ $book->title }}</td>
                    <td tabindex="0">{{ $book->author }}</td>
                    <td tabindex="0">{{ $book->literary_gender }}</td>
                    <td tabindex="0">{{ $book->publisher }}</td>
                    <td tabindex="0">{{ $book->year }}</td>
                    <td tabindex="0">
                        @if ($book->isbn == null)
                            N/A

                            @else
                                {{ $book->isbn }}
                        @endif
                    </td>
                    <td tabindex="0">
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
                                <a class="btn-actions btn-action-change" href="{{url("/acervo/{$book->id}/editar")}}" class="edit" title="Editar" tabindex="0">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-pencil.svg') }}" alt="Ícone Lápis">
                                </a>
                                <button class="btn-actions btn-action-delete" type="submit" title="Excluir" tabindex="0">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-trash.svg') }}" alt="Ícone Lixeira">
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