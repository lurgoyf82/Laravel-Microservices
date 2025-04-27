<?php

    namespace App\Services;

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\File;

    class JwtService
    {
        protected $privateKey;
        protected $publicKey;
        protected $algo;
        protected $accessTtl;

        public function __construct()
        {
            $this->privateKey = File::get(config('jwt.private_key_path'));
            $this->publicKey  = File::get(config('jwt.public_key_path'));
            $this->algo       = config('jwt.algo');
            $this->accessTtl  = config('jwt.access_ttl');
        }

        public function issueAccessToken(int $userId, array $claims = []): string
        {
            $now = Carbon::now()->getTimestamp();
            $payload = array_merge($claims, [
                'sub' => $userId,
                'iat' => $now,
                'exp' => $now + $this->accessTtl,
                'iss' => config('app.url'),
            ]);
            return JWT::encode($payload, $this->privateKey, $this->algo);
        }

        public function validateToken(string $jwt): object
        {
            return JWT::decode($jwt, new Key($this->publicKey, $this->algo));
        }
    }
