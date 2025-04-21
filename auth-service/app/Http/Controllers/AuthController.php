<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Factories\JwtProviderFactory;

class AuthController extends Controller
{
    protected $jwtProvider;

    public function __construct()
    {
        $this->jwtProvider = JwtProviderFactory::make();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $this->jwtProvider->issueToken($user);
        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Credenziali non valide'], 401);
        }

        $token = $this->jwtProvider->issueToken($user);
        return response()->json(['token' => $token]);
    }

    public function refresh(Request $request)
    {
        $header = $request->header('Authorization');
        $token = substr($header, 7);
        $newToken = $this->jwtProvider->refreshToken($token);
        return response()->json(['token' => $newToken]);
    }

    public function logout(Request $request)
    {
        // Invalidate token (tymon/jwt-auth)
        $header = $request->header('Authorization');
        $token = substr($header, 7);
        try {
            app(\Tymon\JWTAuth\JWTAuth::class)->setToken($token)->invalidate();
            return response()->json(['message' => 'Logout eseguito']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Impossibile invalidare token'], 500);
        }
    }
}
