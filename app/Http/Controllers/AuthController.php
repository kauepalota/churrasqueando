<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth()
    {
        Log::info('AuthController: auth method called.');

        if (Auth::check()) {
            Log::info('User is already authenticated, redirecting to barbecues.index.');
            return redirect()->route('barbecues.index');
        }

        return view('login');
    }

    public function loginOrRegister(Request $request)
    {
        Log::info('AuthController: loginOrRegister method called.');

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $messages = [
            'email.required' => 'Porfavor insira um email.',
            'email.email' => 'Porfavor insira um email valido.',
            'password.required' => 'Porfavor insira a sua senha corretamente.',
            'password.min' => 'Sua senha precisa ter no mínimo 8 caracteres.',
        ]);

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            Log::info('Login successful for user: ' . $credentials['email']);
            $request->session()->regenerate();
            return redirect()->intended(route('barbecues.index'));
        }

        // If login fails, try to register
        if (!User::where('email', $credentials['email'])->exists()) {
            $user = new User();
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);
            $user->save();

            Log::info('User registered and logged in: ' . $credentials['email']);
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended(route('barbecues.index'));
        }

        // If user exists but password is incorrect, return error
        Log::warning('Login attempt failed for user: ' . $credentials['email']);
        return back()->withErrors([
            'password' => 'A senha está incorreta.',
        ])->withInput();
    }
}
