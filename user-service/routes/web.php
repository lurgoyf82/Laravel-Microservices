<?php

use Illuminate\Support\Facades\Route;

var_dump('hola');
die();

Route::get('/', function () {
    return view('welcome');
});
