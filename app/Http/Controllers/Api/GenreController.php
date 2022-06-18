<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Http\Resources\GenreResource;

class GenreController extends Controller
{
    public function index(){
        $results = GenreResource::collection(Genre::all());
        
        $response = [
            'genres' => $results
        ];

        return response()->json($response, 200);
    }
}
