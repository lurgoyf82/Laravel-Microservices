<?php
    namespace App\Services;

    use Illuminate\Support\Facades\Http;
    use Illuminate\Http\Request;

    class HttpForwarder
    {
        public function forward(Request $req, string $url, array $headers): \Illuminate\Http\Client\Response
        {
            return Http::withHeaders($headers)
                ->withBody($req->getContent(), $req->header('Content-Type','application/json'))
                ->timeout(10)
                ->send($req->method(), $url, ['query'=>$req->query()]);
        }
    }
