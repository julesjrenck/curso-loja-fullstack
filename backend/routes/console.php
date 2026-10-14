<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('loja:verificar-banco', function () {
    $resultado = DB::selectOne(
        'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login, USER_NAME() AS usuario'
    );

    $this->line('Banco: '.$resultado->banco);
    $this->line('Login: '.$resultado->login);
    $this->line('Usuário: '.$resultado->usuario);
})->purpose('Verifica a conexão Laravel com o banco da loja');
