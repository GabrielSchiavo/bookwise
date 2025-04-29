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
            <h3>Gêneros Literários</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th class="th-end">Ações</th>
                </tr>
            </thead>
            <tbody  class="table-content-center">
                @foreach ($listLiteraryGenres as $literaryGenre)
                <tr>
                    <td>{{ $literaryGenre->id }}</td>
                    <td>{{ $literaryGenre->name }}</td>
                    <td>
                        <form action="/generos-literarios/{{$literaryGenre->id}}/excluir" method="POST" onsubmit="return confirm('Deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/generos-literarios/{$literaryGenre->id}/editar")}}" tabindex="0" class="edit" tabindex="0" title="Editar">
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