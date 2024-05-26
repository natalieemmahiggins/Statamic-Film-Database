<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function get() {
        $bearer = env('TMDB_BEARER');

        $response = Http::withHeaders([
            'Authorization' => $bearer,
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/movie/top_rated');
    
        dd($response->body());
    }
}
