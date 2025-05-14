@extends('layout')

@section('tituloGuia')
    BookWise - Dashboard
@endsection

@section('optionSideMenu01')
active
@endsection

@section('searchAction')
/dashboard
@endsection

@section('conteudo')
<div class="layout-grid">
    <div class="head">
        <h3 class="text" tabindex="0">Dashboard</h3>
    </div>
    <ul class="box-info">
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-books.svg') }}" alt="Ícone Livros">
            </div>
            <span class="text">
                <h3 tabindex="0">{{ $bookCount }}</h3>
                <p tabindex="0">Livros</p>
            </span>
        </li>
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-users.svg') }}" alt="Ícone Usuários">
            </div>
            <span class="text">
                <h3 tabindex="0">{{ $personsCount }}</h3>
                <p tabindex="0">Pessoas</p>
            </span>
        </li>
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-arrows.svg') }}" alt="Ícone setas">
            </div>
            <span class="text">
                <h3 tabindex="0">{{ $loanBooksCount }}</h3>
                <p tabindex="0">Retirados & Renovados</p>
            </span>
        </li>
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-calendar-clock.svg') }}" alt="Ícone calendário relógio">
            </div>
            <span class="text">
                <h3 tabindex="0">{{ $lateBooksCount }}</h3>
                <p tabindex="0">Atrasados</p>
            </span>
        </li>
    </ul>
    
    <div class="data-container">
        <div class="layout-two-tables">
            <div class="data-content">
                <div class="head">
                    <h3 tabindex="0">Retirados & Renovados</h3>
                </div>
                <table>
                    <thead  class="table-content-center">
                        <tr>
                            <th tabindex="0">ID</th>
                            <th tabindex="0">Data da Retirada</th>
                            <th tabindex="0">Data da Devolução</th>
                            <th tabindex="0">ID Pessoa</th>
                            <th tabindex="0" >Pessoa</th>
                            <th tabindex="0">ID Livro</th>
                            <th tabindex="0">Livro</th>
                            <th tabindex="0">Status</th>
                            <th class="th-end" tabindex="0">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-content-center">
                        @foreach ($loanBooksList as $retirada)
                        <tr>
                            <td tabindex="0">{{ $retirada->id }}</td>
                            <td tabindex="0">{{ \Carbon\Carbon::parse($retirada->loan_date)->format('d/m/Y') }}</td>
                            <td tabindex="0">{{ \Carbon\Carbon::parse($retirada->return_date)->format('d/m/Y') }}</td>
                            <td tabindex="0">{{ $retirada->person_id }}</td>
                            <td tabindex="0">{{ $retirada->person }}</td>
                            <td tabindex="0">{{ $retirada->book_id }}</td>
                            <td tabindex="0">{{ $retirada->book }}</td>
                            <td tabindex="0">
                                @if ($retirada->status == 'RETIRADO')
                                    <p class="status status-yellow">Retirado</p>
        
                                    @elseif ($retirada->status == 'RENOVADO')
                                        <p class="status status-orange">Renovado</p>

                                    @elseif ($retirada->status == 'DISPONIVEL')
                                        <p class="status status-green">Devolvido</p>
        
                                    @elseif ($retirada->status == 'ATRASADO')
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
                @if (count($loanBooksList) === 0)
                    <span class="text table-placeholder-text">Nada para mostrar... por enquanto!</span>
                @endif
            </div>
            <div class="data-content">
                <div class="head">
                    <h3>Atrasados</h3>
                </div>
                <table>
                    <thead  class="table-content-center">
                        <tr>
                            <th tabindex="0">Data da Retirada</th>
                            <th tabindex="0">ID</th>
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
                        @foreach ($lateBooksList as $retirada)
                        <tr>
                            <td tabindex="0">{{ $retirada->id }}</td>
                            <td tabindex="0">{{ \Carbon\Carbon::parse($retirada->loan_date)->format('d/m/Y') }}</td>
                            <td tabindex="0">{{ \Carbon\Carbon::parse($retirada->return_date)->format('d/m/Y') }}</td>
                            <td tabindex="0">{{ $retirada->person_id }}</td>
                            <td tabindex="0">{{ $retirada->person }}</td>
                            <td tabindex="0">{{ $retirada->book_id }}</td>
                            <td tabindex="0">{{ $retirada->book }}</td>
                            <td tabindex="0">
                                @if ($retirada->status == 'RETIRADO')
                                    <p class="status status-yellow">Retirado</p>
        
                                    @elseif ($retirada->status == 'RENOVADO')
                                        <p class="status status-orange">Renovado</p>

                                    @elseif ($retirada->status == 'DISPONIVEL')
                                        <p class="status status-green">Devolvido</p>
        
                                    @elseif ($retirada->status == 'ATRASADO')
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
                @if (count($lateBooksList) === 0)
                    <span class="text table-placeholder-text">Nada para mostrar... por enquanto!</span>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection