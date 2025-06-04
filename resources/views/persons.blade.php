@extends('layout')

@section('titleGuide')
    BookWise - Pessoas
@endsection

@section('optionSideMenu04')
active
@endsection

@section('searchAction')
/pessoas
@endsection

@section('conteudo')
@if(!empty($message))
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
    <div class="data-content">
        <div class="head">
            <h3 tabindex="0">Pessoas</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th tabindex="0">ID</th>
                    <th tabindex="0">Nome</th>
                    <th tabindex="0">Telefone</th>
                    <th tabindex="0">Email</th>
                    <th class="th-end" tabindex="0">Ações</th>
                </tr>
            </thead>
            <tbody  class="table-content-center">
                @foreach ($personsList as $person)
                <tr>
                    <td tabindex="0">{{ $person->id }}</td>
                    <td tabindex="0">{{ $person->name_last_name }}</td>
                    <td class="phoneMask" tabindex="0">{{ $person->phone }}</td>
                    <td tabindex="0">{{ $person->email }}</td>
                    <td tabindex="0">
                        <form action="/pessoas/{{$person->id}}/excluir" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/pessoas/{$person->id}/editar")}}" class="edit" title="Editar" aria-label="Editar pessoa" tabindex="0">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-pencil.svg') }}" alt="Ícone Lápis">
                                </a>
                                <button class="btn-actions btn-action-delete" type="submit" title="Excluir" aria-label="Excluir pessoa" tabindex="0">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-trash.svg') }}" alt="Ícone Lixeira">
                                </button>
                            </div>
                        </form>
                        @include('components.modal-confirm-delede')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if (count($personsList) === 0)
            <span class="text table-placeholder-text">Nada para mostrar... por enquanto!</span>
        @endif
    </div>
</div>

@endsection