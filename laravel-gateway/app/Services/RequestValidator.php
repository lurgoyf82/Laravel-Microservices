<?php
    namespace App\Services;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\RateLimiter;

    class RequestValidator
    {
        public function validate(Request $req, array $cfg): ?\Symfony\Component\HttpFoundation\Response
        {
// version
            if (! preg_match('/^v[0-9]+$/', $req->route('version'))) {
                return response()->json(['error'=>'Invalid version'], 400);
            }

// auth
            if ($cfg['auth'] && ! $req->bearerToken()) {
                return response()->json(['error'=>'Unauthorized'], 401);
            }

// rate-limit
            $key = $cfg['id'].'|'.$req->ip();
            if (RateLimiter::tooManyAttempts($key, (int)$cfg['rate_limit'])) {
                return response()->json(['error'=>'Too Many Requests'], 429);
            }
            RateLimiter::hit($key);

            return null; // ok
        }
    }
