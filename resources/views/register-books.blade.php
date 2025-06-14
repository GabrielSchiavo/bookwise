@extends('layout')

@section('titleGuide')
    BookWise - Cadastro de Livros
@endsection

@section('optionSideMenu07')
    active
@endsection

@section('searchAction')
/acervo/cadastro
@endsection

@section('conteudo')
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
            <div class="head full-width-mobile">
                <h3 tabindex="0">Cadastro de Livros</h3>
            </div>
            <div class="form-container">
                <form class="form-body full-width-mobile" action="/acervo/cadastro" method="POST" enctype="multipart/form-data">
                    @csrf
            
                    <input type="hidden" name="id" value="{{isset($book) ? $book->id : old('id')}}" />                
                    <input type="hidden" name="literary_gender_id" value="{{isset($book) ? $book->literary_gender_id : old('literary_gender_id')}}" />                

                    <div class="input-container">
                        <label class="input-label" for="literaryGender" class="form-label" tabindex="0">Gênero Literário <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area select-area cursor-pointer" id="literaryGender" name="literary_gender">
                                <option class="option-empty" value="" {{ !isset($book->literary_gender) && !old('literary_gender') ? 'selected' : '' }} disabled hidden>Selecione uma opção...</option>
                                @foreach ($listLiteraryGenres as $literaryGenre)            
                                    <option value="{{ $literaryGenre->name }}"{{ (isset($book) && $book->literary_gender == $literaryGenre->name) || old('literary_gender') == $literaryGenre->name ? 'selected' : '' }}>
                                        {{ $literaryGenre->id }} - {{ $literaryGenre->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-chevron-down.svg') }}" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>
            
                    <div class="input-radio-group">
                        <legend class="input-legend" tabindex="0">Formato ISBN:</legend>
                        
                        <div class="input-radio-container">
                            <input class="input-radio" type="radio" id="isbn_format_13" name="isbnFormat" value="isbn13"/>
                            <label class="input-label input-radio-label" for="isbn_format_13" tabindex="0">ISBN 13</label>
                        </div>
                        <div class="input-radio-container">
                            <input class="input-radio" type="radio" id="isbn_format_10" name="isbnFormat" value="isbn10" />
                            <label class="input-label input-radio-label" for="isbn_format_10" tabindex="0">ISBN 10</label>
                        </div>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="isbn" class="form-label" tabindex="0">ISBN</label>
                        <input class="input-area isbnMask" type="text" id="isbn" name="isbn" value="{{isset($book) ? $book->isbn : old('isbn')}}" placeholder="Digite o código ISBN">
                    </div>
                   <div class="input-container">
                        <label class="input-label" for="title" class="form-label" tabindex="0">Título <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="title" name="title" value="{{isset($book) ? $book->title : old('title')}}" placeholder="Digite o título">
                    </div>
                   <div class="input-container">
                        <label class="input-label" for="series" class="form-label" tabindex="0">Série</label>
                        <input class="input-area" type="text" id="series" name="series" value="{{isset($book) ? $book->series : old('series')}}" placeholder="Digite a série">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="volume" class="form-label" tabindex="0">Volume</label>
                        <input class="input-area" type="number" id="volume" name="volume" value="{{isset($book) ? $book->volume : old('volume')}}" placeholder="Digite o volume">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="author" class="form-label" tabindex="0">Autor <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="author" name="author" value="{{isset($book) ? $book->author : old('author')}}" placeholder="Digite o autor">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="publisher" class="form-label" tabindex="0">Editora <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="publisher" name="publisher" value="{{isset($book) ? $book->publisher : old('publisher')}}" placeholder="Digite a editora">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="year" class="form-label" tabindex="0">Ano <span class="form-require">*</span></label>
                        <input class="input-area" type="number" id="year" name="year" value="{{isset($book) ? $book->year : old('year')}}" placeholder="Digite o ano">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="cover_image" class="form-label" tabindex="0">Capa:</label>
                        <input class="input-area cursor-pointer input-file-upload" type="file" id="cover_image" name="cover_image" value="{{isset($book) ? $book->cover_image : old('cover_image')}}"  accept="image/*">
                        @if (isset($book) ? $book->cover_image : old('cover_image'))
                            <p class="text"><strong>Imagem atual:</strong> {{ $saveCoverImage }}</p>
                        @endif
                    </div>

                    
                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit" tabindex="0"><span>Salvar</span></button>
                        <a class="btn btn-secondary" type="button" href="/acervo" tabindex="0"><span>Cancelar</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
