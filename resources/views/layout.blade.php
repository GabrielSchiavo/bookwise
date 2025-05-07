<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/assets/images/favicons/favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/assets/images/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/assets/images/favicons/favicon-192x192.png') }}">

    <!-- CSS -->
    @vite(['resources/assets/css/style.css'])

    <title>@yield('tituloGuia')</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <div class="brand-container">
            <a href="/" class="brand" tabindex="-1">
                <img class="logo-img" src="{{ Vite::asset('resources/assets/images/favicons/bookwise-icon.png') }}" alt="Logo BookWise">
                <span class="logo-text">Book<span class="text-bold-logo">Wise</span>
            </a>
        </div>
        <ul class="side-menu accent-color-hover">
            <li class="@yield('optionSideMenu01')">
                <a class="option-side-menu" aria-current="page" href="/dashboard" title="Dashboard">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-dashboard.svg') }}" alt="Ícone Dashboard">
                    <span class="text text-ellipsis">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu accent-color-hover">
            <li class="@yield('optionSideMenu02')">
                <a class="option-side-menu" aria-current="page" href="/generos-literarios" title="Gêneros Literários">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-bookmark.svg') }}" alt="Ícone Gênero Literário">
                    <span class="text text-ellipsis">Gêneros Literários</span>
                </a>
            </li>

            <li class="@yield('optionSideMenu03')">
                <a class="option-side-menu" aria-current="page" href="/acervo" title="Acervo">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-books.svg') }}" alt="Ícone Livro">
                    <span class="text text-ellipsis">Acervo</span>
                </a>
            </li>

            <li class="@yield('optionSideMenu04')">
                <a class="option-side-menu" aria-current="page" href="/pessoas" title="Pessoas">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-users.svg') }}" alt="Ícone Usuários">
                    <span class="text text-ellipsis">Pessoas</span>
                </a>
            </li>

            <li class="@yield('optionSideMenu05')">
                <a class="option-side-menu" aria-current="page" href="/retiradas" title="Retiradas/Devoluções">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-calendar.svg') }}" alt="Ícone Retiradas">
                    <span class="text text-ellipsis">Retiradas/Devoluções</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu accent-color-hover">
            <li class="@yield('optionSideMenu06')">
                <a class="option-side-menu" aria-current="page" href="/generos-literarios/cadastro" title="Cadastro Gêneros">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-add-bookmark.svg') }}" alt="Ícone Cadastro Gênero Literário">
                    <span class="text text-ellipsis">Cadastro Gêneros</span>
                </a>
            </li>

            <li class="@yield('optionSideMenu07')">
                <a class="option-side-menu" aria-current="page" href="/acervo/cadastro" title="Cadastro Livros">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-add-book.svg') }}" alt="Ícone Cadastro Livros">
                    <span class="text text-ellipsis">Cadastro Livros</span>
                </a>
            </li>

            <li class="@yield('optionSideMenu08')">
                <a class="option-side-menu" aria-current="page" href="/pessoas/cadastro" title="Cadastro Pessoas">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-add-user.svg') }}" alt="Ícone Cadastro Usuários">
                    <span class="text text-ellipsis">Cadastro Pessoas</span>
                </a>
            </li>

            <li class="@yield('optionSideMenu09')">
                <a class="option-side-menu" aria-current="page" href="/retiradas/cadastro" title="Cadastro Retiradas/Devoluções">
                    <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-add-calendar.svg') }}" alt="Ícone Cadastro Retiradas">
                    <span class="text text-ellipsis">Cadastro Retiradas/Devoluções</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu accent-color-hover end-margin">
            <li>
                <button class="option-side-menu" id="switch-mode" title="Alterar Tema Claro/Escuro">
                    <div class="switch-mode-option">
                        <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-moon.svg') }}" alt="Ícone Lua">
                        <span class="text text-ellipsis">Modo Escuro</span>
                    </div>
                    <div class="switch-mode-option">
                        <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-sun.svg') }}" alt="Ícone Sol">
                        <span class="text text-ellipsis">Modo Claro</span>
                    </div>
                </button>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <a id="btn-menu" title="Abrir/Fechar Menu" tabindex="0">
                <img id="svg-change-color" class="svg-color svg-icon-size-medium" src="{{ Vite::asset('resources/assets/images/icons/icon-menu.svg') }}" alt="Ícone Menu">
            </a>

            <form class="search-form" action="@yield('searchAction')" method="GET">
                <div class="search-input-container">
                    <input class="input-area search-input" type="search" name="search" id="search" placeholder="Pesquisar...">
                    <button type="submit" id="search-btn" class="btn btn-primary btn-search" title="Pesquisar">
                        <span>
                            <img id="svg-change-color" class="svg-color svg-icon-size" src="{{ Vite::asset('resources/assets/images/icons/icon-search.svg') }}" alt="Ícone Pesquisa">
                        </span>
                    </button>
                </div>
            </form>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            @yield('conteudo')
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- JS -->
    @vite(['resources/assets/js/script.js'])
</body>

</html>