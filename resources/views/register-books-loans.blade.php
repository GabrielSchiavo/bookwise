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
            
                    <input type="hidden" name="id"  value="{{isset($bookLoan) ? $bookLoan->id : old('id')}}" />
                    <input type="hidden" name="literary_gender_id" value="{{isset($bookLoan) ? $bookLoan->book_id : old('book_id')}}" />
                    
                    <div class="input-container">
                        <label class="input-label" for="loan_date" class="form-label">Data de Retirada <span class="form-require">*</span></label>
                        <input class="input-area cursor-pointer" type="date" id="loan_date" name="loan_date" value="{{isset($bookLoan) ? $bookLoan->loan_date : old('loan_date')}}">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="return_date" class="form-label">Data de Devolução <span class="form-require">*</span></label>
                        <input class="input-area cursor-pointer" type="date" id="return_date" name="return_date" value="{{isset($bookLoan) ? $bookLoan->return_date : old('return_date')}}">
                    </div>
            
                    <div class="input-container">
                        <label class="input-label" for="book" class="form-label">Livro <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="book" name="book">
                                <option value="{{isset($bookLoan) ? $bookLoan->book : old('book')}}" selected>{{isset($bookLoan) ? $bookLoan->book : old('book')}}</option>
                                @foreach ($booksList as $book)
                                    @if ($book->status == 3)
                                        <option value="{{$book->title}}">{{$book->id}} - {{$book->title}}</option>
                                    @endif            
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="/assets/images/icons/icon-chevron-down.svg" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="person" class="form-label">Pessoa <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="person" name="person">
                                <option value="{{isset($bookLoan) ? $bookLoan->person : old('person')}}" selected>{{isset($bookLoan) ? $bookLoan->person : old('person')}}</option>
                                @foreach ($personsList as $person)            
                                    <option value="{{$person->name_last_name}}">{{$person->id}} - {{$person->name_last_name}}</option>
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="/assets/images/icons/icon-chevron-down.svg" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <label class="input-label" for="status" class="form-label">Status <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area cursor-pointer" id="status" name="status">
                                <option value="{{isset($bookLoan) ? $bookLoan->status : old('status')}}" selected>{{isset($bookLoan) ? $bookLoan->status : old('status')}}</option>
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
