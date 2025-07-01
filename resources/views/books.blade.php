@extends('layout')

@section('titleGuide')
    BookWise - Acervo
@endsection

@section('optionSideMenu03')
    active
@endsection

@section('searchAction')
    /acervo
@endsection

@section('conteudo')
    @if (!empty($message))
        <div class="alert-container">
            <div class="alert alert-success">
                <p>{!! $message !!}</p>
            </div>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert-container">
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">
                    <p>{!! $error !!}</p>
                </div>
            @endforeach
        </div>
    @endif

    <div class="data-container">
        <div class="data-content">
            <div class="head">
                <h3 tabindex="0">Acervo</h3>
            </div>
            <table>
                <thead class="table-content-center">
                    <tr>
                        <th tabindex="0">ID</th>
                        <th tabindex="0">Capa</th>
                        <th tabindex="0">Título</th>
                        <th tabindex="0">Série</th>
                        <th tabindex="0">Volume</th>
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
                            <td class="td-cover-image table-content-center" tabindex="0">
                                @if ($book->cover_image == null)
                                    <img class="td-img"
                                        src="{{ Vite::asset('resources/assets/images/default/cover-not-available.png') }}"
                                        alt="Imagem capa do book genérica">
                                @else
                                    <img class="td-img" src="/storage/upload/cover_images/{{ $book->cover_image }}"
                                        onerror="this.src='{{ Vite::asset('resources/assets/images/default/cover-not-available.png') }}'"
                                        alt="Imagem capa do book">
                                @endif
                            </td>
                            <td tabindex="0">{{ $book->title }}</td>
                            <td tabindex="0">
                                @if ($book->series == null)
                                    -
                                @else
                                    {{ $book->series }}
                                @endif
                            </td>
                            <td tabindex="0">
                                @if ($book->volume == null)
                                    Único
                                @else
                                    {{ $book->volume }}
                                @endif
                            </td>
                            <td tabindex="0">{{ $book->author }}</td>
                            <td tabindex="0">{{ $book->literary_gender }}</td>
                            <td tabindex="0">{{ $book->publisher }}</td>
                            <td tabindex="0">{{ $book->year }}</td>
                            <td tabindex="0">
                                @if ($book->isbn == null)
                                    -
                                @else
                                    {{ $book->isbn }}
                                @endif
                            </td>
                            <td tabindex="0">
                                @if ($book->status == 'RETIRADO')
                                    <p class="status status-yellow">Retirado</p>
                                @elseif ($book->status == 'RENOVADO')
                                    <p class="status status-orange">Renovado</p>
                                @elseif ($book->status == 'DISPONIVEL')
                                    <p class="status status-green">Disponível</p>
                                @elseif ($book->status == 'ATRASADO')
                                    <p class="status status-red">Atrasado</p>
                                @endif
                            </td>
                            <td>
                                <form action="/acervo/{{ $book->id }}/excluir" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btns-actions-container">
                                        <a class="btn-actions btn-action-change"
                                            href="{{ url("/acervo/{$book->id}/editar") }}" title="Editar"
                                            aria-label="Editar livro" tabindex="0">
                                            <img id="svg-change-color" class="svg-color svg-icon-size-small"
                                                src="{{ Vite::asset('resources/assets/images/icons/icon-pencil.svg') }}"
                                                alt="Ícone Lápis">
                                        </a>
                                        <button class="btn-actions btn-action-delete" type="submit" title="Excluir"
                                            aria-label="Excluir livro" tabindex="0">
                                            <img id="svg-change-color" class="svg-color svg-icon-size-small"
                                                src="{{ Vite::asset('resources/assets/images/icons/icon-trash.svg') }}"
                                                alt="Ícone Lixeira">
                                        </button>
                                        <a class="btn-actions btn-action-gradient"
                                            href="{{ url("/acervo/{$book->id}/ia/sinopse") }}" title="SinopseAI"
                                            aria-label="ia" tabindex="0">
                                            <span class="spacing-btn-action-gradient">
                                                <img id="svg-change-color" class="svg-color svg-icon-size-small"
                                                    src="{{ Vite::asset('resources/assets/images/icons/icon-stars.svg') }}"
                                                    alt="Ícone Estrelas">
                                            </span>
                                        </a>
                                    </div>
                                </form>
                                @include('components.modal-confirm-delede')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($booksList) === 0)
                <span class="text table-placeholder-text">Nada para mostrar... por enquanto!</span>
            @endif
        </div>
    </div>
@endsection
