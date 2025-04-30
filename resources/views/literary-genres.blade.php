@extends('layout')

@section('tituloGuia')
    BookWise - Gêneros Literários
@endsection

@section('optionSideMenu02')
active
@endsection

@section('searchAction')
/generos-literarios
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
            <h3 tabindex="0">Gêneros Literários</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th tabindex="0">ID</th>
                    <th tabindex="0">Nome</th>
                    <th class="th-end" tabindex="0">Ações</th>
                </tr>
            </thead>
            <tbody  class="table-content-center">
                @foreach ($listLiteraryGenres as $literaryGenre)
                <tr>
                    <td tabindex="0">{{ $literaryGenre->id }}</td>
                    <td tabindex="0">{{ $literaryGenre->name }}</td>
                    <td tabindex="0">
                        <form action="/generos-literarios/{{$literaryGenre->id}}/excluir" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/generos-literarios/{$literaryGenre->id}/editar")}}" class="edit" title="Editar" tabindex="0">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-pencil.svg') }}" alt="Ícone Lápis">
                                </a>
                                <flux:modal.trigger name="modal-confirm-delete">
                                    <a class="btn-actions btn-action-delete" tabindex="0">
                                        <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-trash.svg') }}" alt="Ícone Lixeira">
                                    </a>
                                </flux:modal.trigger>

                                <x-modal-confirm-delede/>
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