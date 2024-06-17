<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function create_token(Request $request){
        $validated = $request->validate([
            'token_name' => 'required|string|max:50'
        ]);

        $token = $request->user()->createToken($validated['token_name']);

        return ['token' => $token->plainTextToken];
    }
}
