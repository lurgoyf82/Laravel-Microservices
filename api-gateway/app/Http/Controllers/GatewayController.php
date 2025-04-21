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
    public function proxy(Request $request, string $service)
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
}
