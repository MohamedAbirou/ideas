<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        // validate
        $validated = $request->validate([
            "name" => "required|min:3|max:40",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:8|max:12",
        ]);

        // create user
        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        // redirect
        return redirect()->route("dashboard")->with("success", "User registered successfully!");
    }

    public function login()
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        // validate
        $validated = $request->validate([
            "email" => "required|email",
            "password" => "required|min:8|max:12",
        ]);

        // login the user
        if (auth()->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success", "logged in successfully!");
        }

        // redirect
        return redirect()->route("login")->withErrors([
            "email" => "Invalid Credentials!",
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->regenerate();

        return redirect()->route("dashboard")->with("success", "Logged out successfully!");
    }
}
