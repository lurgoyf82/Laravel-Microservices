<?php

use Illuminate\Support\Facades\Route;

var_dump('hola');
die();

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('api')
     ->middleware('api')
     ->group(base_path('routes/api.php'));

