@extends('layout')

@section('tituloGuia')
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

<div class="data-container">
    <div class="data-content">
        <div class="head">
            <h3>Pessoas</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th class="th-end">Ações</th>
                </tr>
            </thead>
            <tbody  class="table-content-center">
                @foreach ($personsList as $person)
                <tr>
                    <td>{{ $person->id }}</td>
                    <td>{{ $person->name_last_name }}</td>
                    <td class="phoneMask">{{ $person->phone }}</td>
                    <td>{{ $person->email }}</td>
                    <td>
                        <form action="/pessoas/{{$person->id}}/excluir" method="POST" onsubmit="return confirm('Deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/pessoas/{$person->id}/editar")}}" tabindex="0" class="edit" tabindex="0" title="Editar">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-pencil.svg') }}" alt="Ícone Lápis">
                                </a>
                                <button class="btn-actions btn-action-delete" type="submit" tabindex="0" title="Excluir">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-trash.svg') }}" alt="Ícone Lixeira">
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection