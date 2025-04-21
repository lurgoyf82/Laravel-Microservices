<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    /**
     * Instrada qualsiasi richiesta verso il microservizio interno.
     * Il prefisso URL definisce il servizio target.
     * Esempio: GET /api/catalog/products -> catalog-service
     */
    public function proxy_old(Request $request, string $service)
    {
        // Recupera configurazione endpoint interno
        $baseUrl = config("gateway.services.{$service}");
        if (! $baseUrl) {
            return new JsonResponse(['error' => 'Servizio non trovato'], 404);
        }

        // Costruisci URL target
        $url = rtrim($baseUrl, '/') . '/' . ltrim($request->path(), "$service/");

        // Forward headers (incluso Authorization)
        $response = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
            'Accept'        => 'application/json',
        ])
        ->send($request->method(), $url, ['json' => $request->all(), 'query' => $request->query()]);

        return new JsonResponse($response->json(), $response->status());
    }

    public function proxy(Request $request, string $service)
    {
        $baseUrl = config("gateway.services.{$service}");
        if (! $baseUrl) {
            return response()->json(['error' => 'Servizio non trovato'], 404);
        }

        // se nella route hai usato ->where('path','.*') e ->defaults('service',...)
        $path = $request->route('path', '');

        $url = rtrim($baseUrl, '/') . '/' . ltrim($path, '/');

        // forward di tutti gli header tranne quelli Hop-by-Hop
        $forwardHeaders = collect($request->headers->all())
            ->except([
                'host', 'connection', 'content-length',
                'accept-encoding', 'keep-alive', 'transfer-encoding'
            ])->mapWithKeys(fn($v,$k) => [$k => implode(';', $v)])
            ->toArray();

        $response = Http::withHeaders($forwardHeaders)
            ->withBody(
                $request->getContent(),
                $request->header('Content-Type') ?? 'application/json'
            )
            ->send($request->method(), $url, [
                'query' => $request->query(),
            ]);

        // prepara la risposta con status, body e headers originali
        return response($response->body(), $response->status())
            ->withHeaders(collect($response->headers())
                ->except(['transfer-encoding', 'connection'])->toArray()
            );
    }

}
