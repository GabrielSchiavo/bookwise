@extends('layout')

@section('titleGuide')
    BookWise - IA
@endsection

@section('optionSideMenu03')
    active
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
        <div class="data-content overflow-hidden">
            <div class="head">
                <h3 tabindex="0">IA</h3>
            </div>
            <div class="synopsis-container">
                <div class="book-info-container">
                    <div class="cover-image-container">
                        @if ($book->cover_image == null)
                            <img class="book-info-img"
                                src="{{ Vite::asset('resources/assets/images/default/cover-not-available.png') }}"
                                alt="Imagem capa do book genérica">
                        @else
                            <img class="book-info-img" src="/storage/upload/cover_images/{{ $book->cover_image }}"
                                onerror="this.src='{{ Vite::asset('resources/assets/images/default/cover-not-available.png') }}'"
                                alt="Imagem capa do book">
                        @endif
                    </div>
                    <div class="book-info-content">
                        <h4 class="book-info-text">Livro: <span class="book-info-text-italic">{!! $book->title !!}</span>
                        </h4>
                        <h4 class="book-info-text">Autor: <span class="book-info-text-italic">{!! $book->author !!}</span>
                        </h4>
                        <h4 class="book-info-text">Volume: <span
                                class="book-info-text-italic">{!! $book->volume !!}</span>
                        </h4>
                    </div>
                </div>
                <div class="body-container">
                    <h4 class="synopsis-header">Sinopse: </h4>
                    <div class="synopsis-wrapper">
                        <div class="synopsis-content">
                            <div class="synopsis-body">
                                <p id="textForCopy">Teste</p>
                            </div>
                        </div>
                        <div class="btns-container space-between">
                            <button class="btn btn-gradient btn-icon-text">
                                <span class="btn-icon-text spacing-btn-gradient">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small"
                                        src="{{ Vite::asset('resources/assets/images/icons/icon-stars.svg') }}"
                                        alt="Ícone Estrelas">
                                    Regerar
                                </span>
                            </button>
                            <button id="btnCopy" class="btn btn-tertiary btn-icon-text"><img id="svg-change-color"
                                    class="svg-color svg-icon-size-small"
                                    src="{{ Vite::asset('resources/assets/images/icons/icon-copy.svg') }}"
                                    alt="Ícone Copiar">
                                <span id="textBtnCopy">
                                    Copiar
                                </span>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
