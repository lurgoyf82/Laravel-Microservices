<?php

    namespace App\Http\Controllers;

    use App\Services\JwtService;
    use App\Repositories\RefreshTokenRepository;
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;

    class AuthController extends Controller
    {
        public function __construct(
            protected JwtService $jwt,
            protected RefreshTokenRepository $rtRepo
        ) {}

        public function login(Request $req): JsonResponse
        {
            $req->validate(['email'=>'required|email','password'=>'required']);
            // authenticate against your user-service (e.g. HTTP call or DB)
            $user = /* … */;
            if (! $user) {
                return response()->json(['error'=>'Invalid credentials'], 401);
            }

            $accessToken = $this->jwt->issueAccessToken($user->id, ['email'=>$user->email]);
            $refresh     = $this->rtRepo->create($user->id, config('jwt.refresh_ttl'));

            return response()->json([
                'access_token'  => $accessToken,
                'token_type'    => 'Bearer',
                'expires_in'    => config('jwt.access_ttl'),
                'refresh_token'=> $refresh->token,
            ]);
        }

        public function refresh(Request $req): JsonResponse
        {
            $req->validate(['refresh_token'=>'required']);
            $stored = $this->rtRepo->findValid($req->refresh_token);
            if (! $stored) {
                return response()->json(['error'=>'Invalid or expired refresh token'], 401);
            }

            // revoke old
            $this->rtRepo->revoke($stored);

            // issue new
            $newAccess  = $this->jwt->issueAccessToken($stored->user_id);
            $newRefresh = $this->rtRepo->create($stored->user_id, config('jwt.refresh_ttl'));

            return response()->json([
                'access_token'  => $newAccess,
                'token_type'    => 'Bearer',
                'expires_in'    => config('jwt.access_ttl'),
                'refresh_token'=> $newRefresh->token,
            ]);
        }
    }
