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
@if(!empty($mensagem))
    <div class="alert-container">
        <div class="alert alert-success">
            <p>{!! $mensagem !!}</p>
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
                @foreach ($listaPessoas as $pessoas)
                <tr>
                    <td>{{ $pessoas->id }}</td>
                    <td>{{ $pessoas->nome }}</td>
                    <td class="phoneMask">{{ $pessoas->telefone }}</td>
                    <td>{{ $pessoas->email }}</td>
                    <td>
                        <form action="/pessoas/{{$pessoas->id}}/excluir" method="POST" onsubmit="return confirm('Deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/pessoas/{$pessoas->id}/editar")}}" tabindex="0" class="editar" tabindex="0" title="Editar">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="/assets/images/icons/icon-pencil.svg" alt="Ícone Lápis">
                                </a>
                                <button class="btn-actions btn-action-delete" type="submit" tabindex="0" title="Excluir">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="/assets/images/icons/icon-trash.svg" alt="Ícone Lixeira">
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