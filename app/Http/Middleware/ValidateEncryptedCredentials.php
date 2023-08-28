<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ValidateEncryptedCredentials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        $encryptedUsername = $request->header('x-encrypted-username');
        $encryptedPassword = $request->header('x-encrypted-password');

        // Decrypt the encrypted values (use your decryption logic)
        $decryptedUsername = decrypt($encryptedUsername);
        $decryptedPassword = decrypt($encryptedPassword);

        $user = User::where('email', $decryptedUsername)->firstOrFail();

        // Validate decrypted username and password (add your validation logic)
        if ($user && $user->password != $decryptedPassword) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $next($request);
    }
}
