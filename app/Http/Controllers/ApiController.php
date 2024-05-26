<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Statamic\Facades\Entry;

class ApiController extends Controller
{
    public function get() {
        $bearer = env('TMDB_BEARER');

        $response = Http::withHeaders([
            'Authorization' => $bearer,
            'accept' => 'application/json',
        ])->get('https://api.themoviedb.org/3/movie/top_rated');
    
        $films = json_decode($response->body())->results;
            
        foreach ($films as $film) {
            //make yaml entry from the api data
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[^\da-z ]/i', '', $film->title) )));
            $entry = Entry::make()
            ->published(true)
            ->collection('films')
            ->data([
                'title' => $film->title, 
                'slug' => $slug,
                'api_id' => $film->id,
                'rating' => $film->vote_average,
                'popularity' => $film->popularity,
                'overview' => $film->overview,
                'release_date' => $film->release_date,
            ]);
            $entry->save();
        }
    }
}
