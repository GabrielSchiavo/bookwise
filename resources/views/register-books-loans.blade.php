@extends('layout')

@section('titleGuide')
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
                <h3 tabindex="0">Cadastro Retiradas/Devoluçaões</h3>
            </div>
            <div class="form-container">
                <form class="form-body full-width-mobile" action="/retiradas/cadastro" method="POST">
                    @csrf
            
                    <input type="hidden" name="id"  value="{{isset($bookLoan) ? $bookLoan->id : old('id')}}" />
                    <input type="hidden" name="literary_gender_id" value="{{isset($bookLoan) ? $bookLoan->book_id : old('book_id')}}" />
                    
                    <div class="input-container">
                        <label class="input-label" for="loan_date" class="form-label" tabindex="0">Data de Retirada <span class="form-require">*</span></label>
                        <input class="input-area input-date cursor-pointer" type="date" id="loan_date" name="loan_date" value="{{isset($bookLoan) ? $bookLoan->loan_date : old('loan_date')}}">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="return_date" class="form-label" tabindex="0">Data de Devolução <span class="form-require">*</span></label>
                        <input class="input-area input-date cursor-pointer" type="date" id="return_date" name="return_date" value="{{isset($bookLoan) ? $bookLoan->return_date : old('return_date')}}">
                    </div>
            
                    <div class="input-container">
                        <label class="input-label" for="book" class="form-label" tabindex="0">Livro <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area select-area cursor-pointer" id="book" name="book">
                                <option class="option-empty" value="" {{ !isset($bookLoan->book) && !old('book') ? 'selected' : '' }} disabled hidden>
                                    Selecione uma opção...
                                </option>
                                
                                @if(isset($bookLoan) && $bookLoan->book)
                                    @if($selectedBook)
                                        <option value="{{ $selectedBook->title }}" selected>
                                            {{ $selectedBook->id }} - {{ $selectedBook->title }}
                                        </option>
                                    @endif
                                @endif
                                
                                @foreach ($booksList as $book)
                                    @if ($book->status == 'DISPONIVEL' && (!isset($bookLoan) || $bookLoan->book != $book->title))
                                        <option value="{{ $book->title }}"
                                            {{ old('book') == $book->title ? 'selected' : '' }}>
                                            {{ $book->id }} - {{ $book->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-chevron-down.svg') }}" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="person" class="form-label" tabindex="0">Pessoa <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area select-area cursor-pointer" id="person" name="person">
                                <option class="option-empty" value="" {{ !isset($bookLoan->person) && !old('person') ? 'selected' : '' }} disabled hidden>
                                    Selecione uma opção...
                                </option>
                                @foreach ($personsList as $person)
                                    <option value="{{ $person->name_last_name }}"
                                        {{ (isset($bookLoan) && $bookLoan->person == $person->name_last_name) || old('person') == $person->name_last_name ? 'selected' : '' }}>
                                        {{ $person->id }} - {{ $person->name_last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-chevron-down.svg') }}" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <label class="input-label" for="status" class="form-label" tabindex="0">Status <span class="form-require">*</span></label>
                        <div class="select-body">
                            <select class="input-area select-area cursor-pointer" id="status" name="status">
                                <option class="option-empty" value="" {{ !isset($bookLoan) && is_null(old('status')) ? 'selected' : '' }} disabled hidden>Selecione uma opção...</option>
                                <option value="RETIRADO" {{ (isset($bookLoan) && $bookLoan->status == 'RETIRADO') || old('status') == 'RETIRADO' ? 'selected' : '' }}>1 - Retirado</option>
                                <option value="RENOVADO" {{ (isset($bookLoan) && $bookLoan->status == 'RENOVADO') || old('status') == 'RENOVADO' ? 'selected' : '' }}>2 - Renovado</option>
                                <option value="DISPONIVEL" {{ (isset($bookLoan) && $bookLoan->status == 'DISPONIVEL') || old('status') == 'DISPONIVEL' ? 'selected' : '' }}>3 - Devolvido</option>
                                <option value="ATRASADO" {{ (isset($bookLoan) && $bookLoan->status == 'ATRASADO') || old('status') == 'ATRASADO' ? 'selected' : '' }}>4 - Atrasado</option>
                            </select>
                            <div class="select-icon-container">
                                <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-chevron-down.svg') }}" alt="Ícone Seta para baixo">
                            </div>
                        </div>
                    </div>


                    <div class="btns-container">
                        <button class="btn btn-primary" type="submit" tabindex="0"><span>Salvar</span></button>
                        <a class="btn btn-secondary" type="button" href="/retiradas" tabindex="0"><span>Cancelar</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
