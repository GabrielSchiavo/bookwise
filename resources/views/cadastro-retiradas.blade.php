@extends('layout')

@section('tituloGuia')
    BookWise - Cadastro Retiradas/Devoluçaões
@endsection

@section('optionSideMenu09')
    active
@endsection

@section('searchAction')
/retiradas/cadastro
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
                <h3>Cadastro Retiradas/Devoluçaões</h3>
            </div>
            <div class="form-container">
                <form class="form-body full-width-mobile" action="/retiradas/cadastro" method="POST">
                    @csrf
            
                    <input type="hidden" name="id"  value="{{isset($retiradas) ? $retiradas->id : old('id')}}" />
                    <input type="hidden" name="genero_id" value="{{isset($retiradas) ? $retiradas->livro_id : old('livro_id')}}" />
                    
                    <div class="input-container">
                        <label class="input-label" for="formDataRetirada" class="form-label">Data de Retirada <span class="form-require">*</span></label>
                        <input class="input-area" type="date" id="dataRetirada" name="dataRetirada" value="{{isset($retiradas) ? $retiradas->dataRetirada : old('dataRetirada')}}">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="formDataDevolucao" class="form-label">Data de Devolução <span class="form-require">*</span></label>
                        <input class="input-area" type="date" id="dataDevolucao" name="dataDevolucao" value="{{isset($retiradas) ? $retiradas->dataDevolucao : old('dataDevolucao')}}">
                    </div>
            
                    <div class="input-container">
                        <label class="input-label" for="formLivro" class="form-label">Livro <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="livro" name="livro">
                                <option value="{{isset($retiradas) ? $retiradas->livro : old('livro')}}" selected>{{isset($retiradas) ? $retiradas->livro : old('livro')}}</option>
                                @foreach ($listaLivros as $livros)
                                    @if ($livros->status == 3)
                                        <option value="{{$livros->titulo}}">{{$livros->id}} - {{$livros->titulo}}</option>
                                    @endif            
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="/assets/images/icons/icon-chevron-down.svg" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="formPessoa" class="form-label">Pessoa <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="pessoa" name="pessoa">
                                <option value="{{isset($retiradas) ? $retiradas->pessoa : old('pessoa')}}" selected>{{isset($retiradas) ? $retiradas->pessoa : old('pessoa')}}</option>
                                @foreach ($listaPessoas as $pessoas)            
                                    <option value="{{$pessoas->nome}}">{{$pessoas->id}} - {{$pessoas->nome}}</option>
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="/assets/images/icons/icon-chevron-down.svg" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <label class="input-label" for="formStatus" class="form-label">Status <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="status" name="status">
                                <option value="{{isset($retiradas) ? $retiradas->status : old('status')}}" selected>{{isset($retiradas) ? $retiradas->status : old('status')}}</option>
                                <option value="1">1 - Retirado</option>
                                <option value="2">2 - Renovado</option>
                                <option value="3">3 - Devolvido</option>
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="/assets/images/icons/icon-chevron-down.svg" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>


                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <a class="btn btn-secondary" type="button" href="/retiradas">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
