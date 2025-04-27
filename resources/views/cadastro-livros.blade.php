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
            
                    <input type="hidden" name="id" value="{{isset($livros) ? $livros->id : old('id')}}" />                
                    <input type="hidden" name="genero_id" value="{{isset($livros) ? $livros->genero_id : old('genero_id')}}" />                

                    <div class="input-container">
                        <label class="input-label" for="formGenero" class="form-label">Gênero Literário <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="genero" name="genero">
                                <option value="{{isset($livros) ? $livros->genero : old('genero')}}" selected>{{isset($livros) ? $livros->genero : old('genero')}}</option>
                                @foreach ($listaGeneros as $generos)            
                                    <option value="{{$generos->nome}}">{{$generos->id}} - {{$generos->nome}}</option>
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="/assets/images/icons/icon-chevron-down.svg" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>
            
                    <legend class="input-legend">Formato ISBN:</legend>
                    <div class="input-radio-group">
                        <div class="input-radio-container">
                            <input class="input-radio" type="radio" id="isbnFormat13" name="isbnFormat" value="isbn13"/>
                            <label class="input-label input-radio-label" for="isbnFormat13">ISBN 13</label>
                        </div>
                        <div class="input-radio-container">
                            <input class="input-radio" type="radio" id="isbnFormat10" name="isbnFormat" value="isbn10" />
                            <label class="input-label input-radio-label" for="isbnFormat10">ISBN 10</label>
                        </div>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="formIsbn" class="form-label">ISBN</label>
                        <input class="input-area isbnMask" type="text" id="isbn" name="isbn" value="{{isset($livros) ? $livros->isbn : old('isbn')}}" placeholder="Digite o código ISBN">
                    </div>
                   <div class="input-container">
                        <label class="input-label" for="formTitulo" class="form-label">Titulo <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="titulo" name="titulo" value="{{isset($livros) ? $livros->titulo : old('titulo')}}" placeholder="Digite o título">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="formAutor" class="form-label">Autor <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="autor" name="autor" value="{{isset($livros) ? $livros->autor : old('autor')}}" placeholder="Digite o autor">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="formEditora" class="form-label">Editora <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="editora" name="editora" value="{{isset($livros) ? $livros->editora : old('editora')}}" placeholder="Digite a editora">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="formAno" class="form-label">Ano <span class="form-require">*</span></label>
                        <input class="input-area" type="number" id="ano" name="ano" value="{{isset($livros) ? $livros->ano : old('ano')}}" placeholder="Digite o ano">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="imgCapa" class="form-label">Capa:</label>
                        <input class="input-area input-file-upload" type="file" id="imgCapa" name="imgCapa" value="{{isset($livros) ? $livros->imgCapa : old('imgCapa')}}"  accept="image/*">
                        @if (isset($livros) ? $livros->imgCapa : old('imgCapa'))
                            <p class="text"><strong>Imagem atual:</strong> {{ $imgCapaSave }}</p>
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
