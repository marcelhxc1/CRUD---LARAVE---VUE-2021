# CRUD - LARAVE + VUE 2021
 
# BACK-END

OBS : Todos os comandos devem ser executados em um terminal ou no cmd acessando a pasta back-end ou front-end dependendo de qual parte estará executando.

1 - Abra o arquivo .env.example e faça uma copia dele, feito a copia renomeie para .env e faça a configuração do banco de dados

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-api
DB_USERNAME=laravel-api
DB_PASSWORD=

2 - Para criar o banco de dados existem duas opções 

2.1 - Executar o comando "php artisan migrate" para que as tabelas sejam criadas automaticamente pelo laravel.
2.2 - Executar o arquivo .sql que está adicionado na pasta DB aqui no repositório.

3 - Feito a inserção do banco de dados seguimos para o procedimento de ligar o servidor da API

php artisan serve

O retorno será como este :

Starting Laravel development server: http://127.0.0.1:8000
[Mon Apr  5 09:50:36 2021] PHP 7.4.13 Development Server (http://127.0.0.1:8000) started

# FRONT-END

1 - Para iniciar abra o terminal e entre na pasta front-end, execute o comando :

npm install

2 - Apos o conteudo todo instalado no mesmo terminal rode o comando

npm run serve

O retorno será :

  App running at:
  - Local:   http://localhost:8080/
  - Network: http://192.168.0.4:8080/

3 - Pronto o front-end está ligado em modo de desenvolvimento.

4 - Para buildar o front-end

npm run build


# Features a serem atualizadas futuramente

- Implementação de melhorias no sistema de pesquisa da listagem
