<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
/*
// qui puoi servire la tua SPA o la landing page Laravel
Route::view('/', 'welcome');

// se usi una SPA JS e vuoi fare fallback su tutte le rotte “web”:

Route::view('/{any}', 'app')
    ->where('any', '.*');


Route::get('/auth-service/{any?}', function ($any = null) {
    // costruisco l’URL di destinazione: porta host 8001, path identico a quello richiesto
    // - 8001 è la porta mappata sul host per il container "auth-service"
    // - $any contiene eventuali segmenti aggiuntivi dopo "/auth-service/"
    $target = 'http://localhost:8001/' . ($any ? $any : '');

    // redirect HTTP (302) al servizio di autenticazione
    return redirect()->to($target);
})
// constraint: accetta qualsiasi cosa dopo /auth-service/, anche vuoto
->where('any', '.*');
/**/

Route::get('/', function () {
    return view('welcome');
});

//Route::any('/auth-service/{any?}', function(Request $request, $any = '') {
//    // 1) L'URL interno: il service name "auth-service" + porta 80 interna
//    $internalUrl = 'http://auth-service/' . ltrim($any, '/');
//
//    // 2) Raccolgo headers (escludo host e forwarding)
//    $headers = collect($request->headers->all())
//        ->except(['host', 'x-forwarded-for', 'x-forwarded-host', 'x-forwarded-proto'])
//        ->map(fn($v, $k) => [$k => $v[0]])
//        ->collapse()
//        ->toArray();
//
//    // 3) Preparo le opzioni: headers, query string e body
//    $options = [
//        'headers' => $headers,
//        'query'   => $request->query(),
//        'body'    => $request->getContent(),
//        'verify'  => false,  // disabilita SSL verify se serve
//    ];
//
//    // 4) Inoltro la richiesta con lo stesso metodo HTTP
//    $response = Http::send($request->method(), $internalUrl, $options);
//
//    // 5) Ritorno al client lo stesso status, body e header ricevuti
//    return response($response->body(), $response->status())
//           ->withHeaders($response->headers());
//})
//->where('any', '.*');
