<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    // restituisco direttamente una stringa HTML con il messaggio
    // potresti anche restituire una view blade personalizzata
    return '<h1>Welcome in Auth‑Service</h1>';
});
