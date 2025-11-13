<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $token = base64_encode(Str::random(60));
        $expiresAt = Carbon::now()->addHour();

        PersonalAccessToken::create([
            'community_id' => $user->community_id,
            'reference_uuid' => $user->uuid,
            'module' => 'auth',
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function validateToken(Request $request)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Token ausente.'], 401);
        }

        $token = substr($authHeader, 7);

        $tokenRecord = PersonalAccessToken::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$tokenRecord) {
            return response()->json(['message' => 'Token inválido ou expirado.'], 401);
        }

        $user = User::where('uuid', $tokenRecord->reference_uuid)->first();

        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {
        $authHeader = $request->header('Authorization');

        if ($authHeader && str_starts_with($authHeader, 'Bearer ')) {
            $token = substr($authHeader, 7);
            PersonalAccessToken::where('token', $token)->delete();
        }

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
