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
            <h3 tabindex="0">Retiradas/Devoluçaões</h3>
        </div>
        <table>
            <thead  class="table-content-center">
                <tr>
                    <th tabindex="0">ID</th>
                    <th tabindex="0">Data da Retirada</th>
                    <th tabindex="0">Data da Devolução</th>
                    <th tabindex="0">ID Pessoa</th>
                    <th tabindex="0">Pessoa</th>
                    <th tabindex="0">ID Livro</th>
                    <th tabindex="0">Livro</th>
                    <th tabindex="0">Status</th>
                    <th class="th-end" tabindex="0">Ações</th>
                </tr>
            </thead>
            <tbody  class="table-content-center">
                @foreach ( $bookLoanList as $retirada)
                <tr>
                    <td tabindex="0">{{ $retirada->id }}</td>
                    <td tabindex="0">{{ \Carbon\Carbon::parse($retirada->loan_date)->format('d/m/Y') }}</td>
                    <td tabindex="0">{{ \Carbon\Carbon::parse($retirada->return_date)->format('d/m/Y') }}</td>
                    <td tabindex="0">{{ $retirada->person_id }}</td>
                    <td tabindex="0">{{ $retirada->person }}</td>
                    <td tabindex="0">{{ $retirada->book_id }}</td>
                    <td tabindex="0">{{ $retirada->book }}</td>
                    <td tabindex="0">
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
                        <form action="/retiradas/{{$retirada->id}}/excluir" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btns-actions-container">
                                <a class="btn-actions btn-action-change" href="{{url("/retiradas/{$retirada->id}/editar")}}" class="edit" title="Editar" aria-label="Editar retirada" tabindex="0">
                                    <img id="svg-change-color" class="svg-color svg-icon-size-small" src="{{ Vite::asset('resources/assets/images/icons/icon-pencil.svg') }}" alt="Ícone Lápis">
                                </a>
                                <button class="btn-actions btn-action-delete" type="submit" title="Excluir" aria-label="Excluir retirada" tabindex="0">
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
        @if (count($bookLoanList) === 0)
            <span class="text table-placeholder-text">Nada para mostrar... por enquanto!</span>
        @endif  
    </div>
</div>

@endsection