<?php

    namespace App\Repositories;

    use App\Models\RefreshToken;
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    class RefreshTokenRepository
    {
        public function create(int $userId, int $ttl): RefreshToken
        {
            return RefreshToken::create([
                'user_id'    => $userId,
                'token'      => Str::random(80),
                'expires_at' => Carbon::now()->addSeconds($ttl),
            ]);
        }

        public function findValid(string $token): ?RefreshToken
        {
            $rt = RefreshToken::where('token',$token)
                ->where('revoked', false)
                ->first();
            return $rt && !$rt->isExpired() ? $rt : null;
        }

        public function revoke(RefreshToken $rt): void
        {
            $rt->update(['revoked'=>true]);
        }
    }
