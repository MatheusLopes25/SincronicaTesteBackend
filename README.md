<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Instalação da API 

## após baixar um projeto Laravel

1 - Instalar as dependências do PHP com o Composer: <br>
Entre na Raiz do projeto 

Execute o comando 
~~~sh
    composer install
~~~


2 - Criar o arquivo de Variaveis de ambiente do laravel 
Renomeie o arquivo
~~~sh 
 .env.example para  .env
~~~

3 - Gerar a chave da aplicação:

~~~sh
    php artisan key:generate
~~~

4 - Configurar o banco de dados no ENV (Opcional)
Edite o arquivo .env com os dados do seu banco (host, nome do banco, usuário, senha).

5 - Rodar as migrations (se o projeto usar banco de dados):

~~~sh
php artisan migrate --seed
~~~

6 - Iniciar o servidor local:
~~~sh
    php artisan serve
~~~

### Use a Collection deixada na raiz desse projeto para fazer os testes a api.

