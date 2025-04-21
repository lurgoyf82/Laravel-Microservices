<?php

use Illuminate\Support\Facades\Route;

// qui puoi servire la tua SPA o la landing page Laravel
Route::view('/', 'welcome');

// se usi una SPA JS e vuoi fare fallback su tutte le rotte “web”:
Route::view('/{any}', 'app')
    ->where('any', '.*');
