@extends('layout')

@section('titleGuide')
    BookWise - BlurbAI
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
                <div class="head-with-btn">
                    <h3 tabindex="0">BlurbAI</h3>
                    <a class="btn btn-tertiary btn-icon-text" href="/acervo" title="Voltar para Acervo">
                        <img id="svg-change-color" class="svg-color svg-icon-size-small"
                            src="{{ Vite::asset('resources/assets/images/icons/icon-arrow-left.svg') }}" alt="Ícone Voltar">
                        <span id="textBtnCopy" class="btn-fit-content">
                            Voltar para Acervo
                        </span>
                    </a>
                </div>
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
                    <div id="bookInfo" class="book-info-content" data-book-id="{{ $book->id }}">
                        <h4 class="book-info-text">Livro: <span class="book-info-text-italic">{!! $book->title !!}</span>
                        </h4>
                        <h4 class="book-info-text">Autor: <span class="book-info-text-italic">{!! $book->author !!}</span>
                        </h4>
                        <h4 class="book-info-text">Volume: <span class="book-info-text-italic">
                                @if ($book->volume == null)
                                    Único
                                @else
                                    {{ $book->volume }}
                                @endif
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="body-container">
                    <h4 class="synopsis-header">Sinopse: </h4>
                    <div class="synopsis-wrapper">
                        <div class="synopsis-content">
                            <div class="synopsis-body">
                                <p id="synopsisText"><x-bladewind::spinner  />Clique em "Gerar" para criar uma sinopse.</p>
                            </div>
                        </div>
                        <div class="btns-container space-between">
                            <button id="regenerateBtn" class="btn btn-gradient btn-icon-text">
                                <span class="btn-icon-text spacing-btn-gradient">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small"
                                        src="{{ Vite::asset('resources/assets/images/icons/icon-stars.svg') }}"
                                        alt="Ícone Estrelas">
                                    <span id="textBtnRegenerate" class="btn-fit-content">
                                        Gerar
                                    </span>
                            </button>
                            <button id="btnCopy" class="btn btn-tertiary btn-icon-text">
                                <img id="svg-change-color" class="svg-color svg-icon-size-small"
                                    src="{{ Vite::asset('resources/assets/images/icons/icon-copy.svg') }}"
                                    alt="Ícone Copiar">
                                <span id="textBtnCopy" class="btn-fit-content">
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
