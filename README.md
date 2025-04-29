<p align="center">
    <img width="450" src="./resources/assets/images/favicons/bookwise-icon-2.png" alt="Logo BookWise"/>
</p>

<h1 align="center">
    BookWise - Gestão de Biblioteca
</h1>

<p align="left">
    <img src="https://img.shields.io/badge/Status-Conclu%C3%ADdo-brightgreen?style=for-the-badge"/>
    <!-- <img src="https://img.shields.io/badge/Status-Em%20Desenvolvimento-orange?style=for-the-badge"/> -->
    <img src="https://img.shields.io/github/license/GabrielSchiavo/bookwise?color=blue&style=for-the-badge"/>
</p>

BookWise visa o controle e cadastro de livros, empréstimos, gêneros literários e pessoas de uma biblioteca.

## :hammer: Funcionalidades
- **Cadastro:**
  - `Cadastro de Gêneros Literários:` cadastro de nome de Gêneros Literários.
  
  - `Cadastro de Livros:` cadastro com Genêro Literário, ISBN, Título, Autor, Editora, Ano e Imagem da Capa.
  
  - `Cadastro de Pessoas:` cadastro com Nome e Sobrenome, Telefone e Email.
  
  - `Cadastro de Retiradas/Devoluções:` cadastro com Data de Retirada, Data de Devolução, Livro, Pessoa e Status.
  
- **Manutenção de Cadastros:**
  - `Edição:` todos os cadastros podem ser editados e atualizados.
  
  - `Exclusão:` cadastros podem ser excluidos.

- **Visualização:**
  - `Dashboard:` tela inicial em formato Dashboard, onde pode ser visualizado o total de livros e pessoas cadastrados. Também é exibidos quantos livros estão retirados e atrasados juntamente com seus registros.

  - `Pesquisa:` é posivel pesquisar por algum registro específico presente nas tabelas.

  - `Modo Escuro:` visualização da interface no Tema Escuro ou Tema Claro.
  
  - `Dispositivos Móveis:` interface otimizada para utilização em dispositivos nóveis.

- **Organização:**
  - `Registros:` todos os cadastros são organizados em tabelas.
  
  - `Status:` os livros e retiradas são organizados por status:
    - **1 - Retirado:** Um book obtém o status `Retirado` quando um cadastro de retirada é criado para este book.
  
    - **2 - Renovado:** Um book retirado pode ser renovado. Para renovar um book o cadastro da retirada deve ser atualizado com o status `Renovado`.
  
    - **3 - Devolvido/Disponível:** Quando um novo book é cadastrado ou não está retirado ele é marcado automaticamento com o status `Disponível`. Já quendo um book retirado é devolvido o cadastro da retirada deve ser atualizada como o status `Devolvido` ou excluída para o book retirado estar disponível para retirada novamente.
  
    - **4 - Atrasado:** Livros com Datas de Devolução anterios a data do dia atual é marcado automaticamente com status `Atrasado`.
  

## :film_strip: Galeria
<p align="center">
  <img src="./resources/assets/images/screenshots/screenshot-dashboard.png" alt="Screenshot Dashboard"/>
  <img src="./resources/assets/images/screenshots/screenshot-register-books.png" alt="Screenshot Cadastro de Livros"/>
  <img src="./resources/assets/images/screenshots/screenshot-books-list.png" alt="Screenshot Acervo"/>
  <img src="./resources/assets/images/screenshots/screenshot-dashboard-mobile.png" alt="Screenshot Dashboard Mobile"/>
</p>

## :file_folder: Acesso ao projeto
Você pode [acessar o código-fonte do projeto](https://github.com/GabrielSchiavo/bookwise) ou [baixá-lo](https://github.com/GabrielSchiavo/bookwise/archive/refs/heads/main.zip).

## 	:hammer_and_wrench: Abrir e rodar o projeto
Após baixar o projeto, deve verificar se possui os seguintes requisitos:

* PHP >=8.4.5
* Composer >=2.8.6
* Node.js >=22.14.0
* PostgreSQL >=17.4

`Configurando o projeto:`
1. Na pasta de instalação do PHP edite o arquivo `php.ini`, neste arquivo descomente as linhas a seguir:
   
   - extension=fileinfo
   - extension=pdo_pgsql
   - extension=pgsql
   
2. `Baixar e atualizar dependências:` Na raiz do projeto abra um terminal e execute:
   
    - Pacotes PHP:
      - Atualiza e intalla pacotes para versão mais recente:

          ```bash
          composer update
          ```

      - Instala pacotes respeitaremos a versão fornecida:
  
          ```bash
          composer install
          ```

    - Pacotes JS:
      - Instala e atualiza pacotes para versão mais recente:
          ```bash
          npm update
          ```

      - Instala pacotes respeitaremos a versão fornecida:
          ```bash
          npm install
          ```
    
3. Após seguir as etapas anteriores, abra o arquivo `.env`, localizado na raiz do projeto e altere as configurações de `DB_CONNECTION` para as configurações do seu Banco de Dados.
   
4. Depois abra um terminal na raiz do projeto e execute os seguintes comandos para configurar o Banco de Dados:
   
   - Cria as tebelas e os relacionamentos executando as migrations:
  
      ```bash
      php artisan migrate
      ```

    - Cria um link simbólico do diretório `storage/app/public` para `public/storage`, tornando esses arquivos acessíveis pela web:
  
      ```bash
      php artisan storage:link
      ```

5. Agora você deve compilar os assets do projeto. Execute o comando abaixo para compilar os assets ou atualizá-los: (`sempre` que atualizar os arquivos `css` e `js` os assets compilados também devem ser atualizados):
   
   - `Compila` e `atuliza` a compilação dos assets:
  
      ```bash
      npm run build
      ```

6. Para executar o projeto, execute o comando a seguir em um terminal na raiz do projeto:
  
   - Inicia o servidor de desenvolvimento local:

      ```bash
      php artisan serve
      ```

## :white_check_mark: Tecnologias utilizadas
* `PHP - 8.4.5`
* `Laravel - 12.7.1`
* `Vite - 6.3.3`
* `Composer - 2.8.6`
* `Node.js - 22.14.0`
* `jQuery - 3.7.1`
* `jQuery Mask - 1.14.16`
* `PostgreSQL - 17.4`
