@extends('layout')

@section('tituloGuia')
    BookWise - Cadastro de Gêneros Literários
@endsection

@section('optionSideMenu06')
    active
@endsection

@section('searchAction')
/generos-literarios/cadastro
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
                <h3>Cadastro de Gêneros Literários</h3>
            </div>
            <div class="form-container">
                <form class="form-body full-width-mobile" action="/generos-literarios/cadastro" method="POST">
                    @csrf
            
                    <input type="hidden" name="id" value="{{isset($generos) ? $generos->id : old('id')}}" />
                    
                    <div class="input-container">
                        <label class="input-label" for="formNome">Nome <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="formNome" name="nome" value="{{isset($generos) ? $generos->nome : old('nome')}}" placeholder="Ficção">
                    </div>
                    
                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <a class="btn btn-secondary" type="button" href="/generos-literarios">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
