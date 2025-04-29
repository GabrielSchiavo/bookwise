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
        <h3 class="text">Dashboard</h3>
    </div>
    <ul class="box-info">
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-books.svg') }}" alt="Ícone Livros">
            </div>
            <span class="text">
                <h3>{{ $bookCount }}</h3>
                <p>Livros</p>
            </span>
        </li>
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-users.svg') }}" alt="Ícone Usuários">
            </div>
            <span class="text">
                <h3>{{ $personsCount }}</h3>
                <p>Pessoas</p>
            </span>
        </li>
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-arrows.svg') }}" alt="Ícone setas">
            </div>
            <span class="text">
                <h3>{{ $loanBooksCount }}</h3>
                <p>Retirados & Renovados</p>
            </span>
        </li>
        <li>
            <div class="dashboard-container-icons">
                <img id="svg-change-color" class="svg-color svg-icon-size-big" src="{{ Vite::asset('resources/assets/images/icons/icon-calendar-clock.svg') }}" alt="Ícone calendário relógio">
            </div>
            <span class="text">
                <h3>{{ $lateBooksCount }}</h3>
                <p>Atrasados</p>
            </span>
        </li>
    </ul>
    
    <div class="data-container">
        <div class="layout-two-tables">
            <div class="data-content">
                <div class="head">
                    <h3>Retirados & Renovados</h3>
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
                    <tbody class="table-content-center">
                        @foreach ($loanBooksList as $retirada)
                        <tr>
                            <td>{{ $retirada->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($retirada->loan_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($retirada->return_date)->format('d/m/Y') }}</td>
                            <td>{{ $retirada->person }}</td>
                            <td>{{ $retirada->book_id }}</td>
                            <td>{{ $retirada->book }}</td>
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
                                        <a class="btn-actions btn-action-change" href="{{url("/retiradas/{$retirada->id}/editar")}}" tabindex="0" class="edit" tabindex="0" title="Editar">
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
            <div class="data-content">
                <div class="head">
                    <h3>Atrasados</h3>
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
                        @foreach ($lateBooksList as $retirada)
                        <tr>
                            <td>{{ $retirada->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($retirada->loan_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($retirada->return_date)->format('d/m/Y') }}</td>
                            <td>{{ $retirada->person }}</td>
                            <td>{{ $retirada->book_id }}</td>
                            <td>{{ $retirada->book }}</td>
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
                                        <a class="btn-actions btn-action-change" href="{{url("/retiradas/{$retirada->id}/editar")}}" tabindex="0" class="edit" tabindex="0" title="Editar">
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
    </div>
</div>

@endsection