<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class TokenController extends Controller
{
    public function store(){
        $data = request()->validate([
            'name' => 'required'
        ]);

        return view('tokens.show', [
            'tokenName' => $data['name'],
            'token' => request()->user()->createToken($data['name'])->plainTextToken
        ]);
    }

    public function destroy(PersonalAccessToken $token){
        $token->delete();

        return redirect(route('dashboard'));
    }
}
