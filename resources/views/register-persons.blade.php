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
            
                    <input type="hidden" name="id" value="{{isset($person) ? $person->id : old('id')}}" />
                    
                    <div class="input-container">
                        <label class="input-label" for="name_last_name" tabindex="0">Nome e Sobrenome <span class="form-require">*</span></label>
                        <input class="input-area" type="text" id="name_last_name" name="name_last_name" value="{{isset($person) ? $person->name_last_name : old('name_last_name')}}" placeholder="José Silva">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="phone" class="form-label" tabindex="0">Telefone <span class="form-require">*</span></label>
                        <input class="input-area phoneMask" type="tel" id="phone" name="phone" value="{{isset($person) ? $person->phone : old('phone')}}" placeholder="(__) _____-____">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="email" class="form-label" tabindex="0">Email <span class="form-require">*</span></label>
                        <input class="input-area" type="email" id="email" name="email" value="{{isset($person) ? $person->email : old('email')}}" placeholder="exemplo@email.com">
                    </div>
                    
                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit" tabindex="0"><span>Salvar</span></button>
                        <a class="btn btn-secondary" type="button" href="/pessoas" tabindex="0"><span>Cancelar</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
