@extends('layout')

@section('tituloGuia')
    BookWise - Cadastro de Pessoas
@endsection

@section('optionSideMenu08')
    active
@endsection

@section('searchAction')
/pessoas/cadastro
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
                <h3>Cadastro de Pessoas</h3>
            </div>
            <div class="form-container">
                <form class="form-body full-width-mobile" action="/pessoas/cadastro" method="POST">
                    @csrf
            
                    <input type="hidden" name="id" value="{{isset($pessoas) ? $pessoas->id : old('id')}}" />
                    
                    <div class="input-container">
                        <label class="input-label" for="formNome">Nome e Sobrenome <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="formNome" name="nome" value="{{isset($pessoas) ? $pessoas->nome : old('nome')}}" placeholder="José Silva">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="formTelefone" class="form-label">Telefone <span class="form-require">*</span></label>
                        <input class="input-area phoneMask" type="tel" id="telefone" name="telefone" value="{{isset($pessoas) ? $pessoas->telefone : old('telefone')}}" placeholder="(__) _____-____">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="formEmail" class="form-label">Email <span class="form-require">*</span></label>
                        <input class="input-area" type="email" id="email" name="email" value="{{isset($pessoas) ? $pessoas->email : old('email')}}" placeholder="exemplo@email.com">
                    </div>
                    
                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <a class="btn btn-secondary" type="button" href="/pessoas">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
