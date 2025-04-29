@extends('layout')

@section('tituloGuia')
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
                <h3>Cadastro de Livros</h3>
            </div>
            <div class="form-container">
                <form class="form-body full-width-mobile" action="/acervo/cadastro" method="POST" enctype="multipart/form-data">
                    @csrf
            
                    <input type="hidden" name="id" value="{{isset($book) ? $book->id : old('id')}}" />                
                    <input type="hidden" name="literary_gender_id" value="{{isset($book) ? $book->literary_gender_id : old('literary_gender_id')}}" />                

                    <div class="input-container">
                        <label class="input-label" for="literaryGender" class="form-label">Gênero Literário <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="literaryGender" name="literary_gender">
                                <option value="{{isset($book) ? $book->literary_gender : old('literary_gender')}}" selected>{{isset($book) ? $book->literary_gender : old('literary_gender')}}</option>
                                @foreach ($listLiteraryGenres as $literaryGenre)            
                                    <option value="{{$literaryGenre->name}}">{{$literaryGenre->id}} - {{$literaryGenre->name}}</option>
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-chevron-down.svg') }}" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>
            
                    <legend class="input-legend">Formato ISBN:</legend>
                    <div class="input-radio-group">
                        <div class="input-radio-container">
                            <input class="input-radio" type="radio" id="isbn_format_13" name="isbnFormat" value="isbn13"/>
                            <label class="input-label input-radio-label" for="isbn_format_13">ISBN 13</label>
                        </div>
                        <div class="input-radio-container">
                            <input class="input-radio" type="radio" id="isbn_format_10" name="isbnFormat" value="isbn10" />
                            <label class="input-label input-radio-label" for="isbn_format_10">ISBN 10</label>
                        </div>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="isbn" class="form-label">ISBN</label>
                        <input class="input-area isbnMask" type="text" id="isbn" name="isbn" value="{{isset($book) ? $book->isbn : old('isbn')}}" placeholder="Digite o código ISBN">
                    </div>
                   <div class="input-container">
                        <label class="input-label" for="title" class="form-label">Titulo <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="title" name="title" value="{{isset($book) ? $book->title : old('title')}}" placeholder="Digite o título">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="author" class="form-label">Autor <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="author" name="author" value="{{isset($book) ? $book->author : old('author')}}" placeholder="Digite o autor">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="publisher" class="form-label">Editora <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="publisher" name="publisher" value="{{isset($book) ? $book->publisher : old('publisher')}}" placeholder="Digite a editora">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="year" class="form-label">Ano <span class="form-require">*</span></label>
                        <input class="input-area" type="number" id="year" name="year" value="{{isset($book) ? $book->year : old('year')}}" placeholder="Digite o ano">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="cover_image" class="form-label">Capa:</label>
                        <input class="input-area cursor-pointer input-file-upload" type="file" id="cover_image" name="cover_image" value="{{isset($book) ? $book->cover_image : old('cover_image')}}"  accept="image/*">
                        @if (isset($book) ? $book->cover_image : old('cover_image'))
                            <p class="text"><strong>Imagem atual:</strong> {{ $saveCoverImage }}</p>
                        @endif
                    </div>

                    
                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <a class="btn btn-secondary" type="button" href="/acervo">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
