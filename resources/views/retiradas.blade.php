@extends('layout')

@section('tituloGuia')
    BookWise - Retiradas/Devoluçaões
@endsection

@section('optionSideMenu05')
active
@endsection

@section('searchAction')
/retiradas
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
            <h3>Retiradas/Devoluçaões</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th>ID</th>
                    <th>Data da Retirada</th>
                    <th>Data da Devolução</th>
                    <th>Pessoa</th>
                    <th>ID Livro</th>
                    <th>Livro</th>
                    <th>Status</th>
                    <th class="th-end">Ações</th>
                </tr>
            </thead>
            <tbody  class="table-content-center">
                @foreach ($listaRetiradas as $retirada)
                <tr>
                    <td>{{ $retirada->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($retirada->dataRetirada)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($retirada->dataDevolucao)->format('d/m/Y') }}</td>
                    <td>{{ $retirada->pessoa }}</td>
                    <td>{{ $retirada->livro_id }}</td>
                    <td>{{ $retirada->livro }}</td>
                    <td>
                        @if ($retirada->status == 1)
                            <p class="status status-yellow">Retirado</p>

                            @elseif ($retirada->status == 2)
                                <p class="status status-orange">Renovado</p>

                            @elseif ($retirada->status == 3)
                                <p class="status status-green">Devolvido</p>

                            @elseif ($retirada->status == 4)
                                <p class="status status-red">Atrasado</p>
                        @endif
                    </td>
                    <td>
                        <form action="/retiradas/{{$retirada->id}}/excluir" method="POST" onsubmit="return confirm('Deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/retiradas/{$retirada->id}/editar")}}" tabindex="0" class="editar" tabindex="0" title="Editar">
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