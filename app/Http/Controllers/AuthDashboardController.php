<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthDashboardController extends Controller
{
    public function authenticate(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Comprueba si la contraseña es 'fauno'
        if ($username !== 'fauno' || $password !== '123quitis(..)') {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    
        $user = Admin::where('username', $username)->first();
    
        if ($user) {
            // Autenticación exitosa, genera el token...
            $token = $user->createToken('adminToken')->plainTextToken;
    
            return ['token' => $token];
        } else {
            // Autenticación fallida...
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}