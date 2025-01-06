<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignupForm(Request $request)
    {
        $token = $request->query('token');

        // Validate the token
        $invitation = Invitation::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$invitation) {
            return abort(404, 'Invalid or expired token.');
        }

        return view('auth.signup', ['token' => $token, 'email' => $invitation->email]);
    }

    public function processSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required',
        ]);

        $invitation = Invitation::where('token', $request->token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$invitation) {
            return redirect()->route('signup')->withErrors('Invalid or expired token.');
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'client_id' => $invitation->client_id,
            'role' => $invitation->role,
        ]);

        // Delete the invitation
        $invitation->delete();

        return redirect()->route('login')->with('success', 'Signup successful! Please log in.');
    }
}

