<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Statamic\Facades\Entry;

class ApiController extends Controller
{
    public function get() {
        $bearer = env('TMDB_BEARER');

        $pages_required = 25; // 20 items per page

        // loop through each page, starting are page 1
        for ($i = 1; $i <= $pages_required; $i++){

            $response = Http::withHeaders([
                'Authorization' => $bearer,
                'accept' => 'application/json',
            ])->get('https://api.themoviedb.org/3/movie/top_rated?page='.$i);
        
            $films = json_decode($response->body())->results;
                
            foreach ($films as $film) {
                // check if there's already an entry
                $existing = Entry::query()
                ->where('collection', 'films')
                ->where('api_id', $film->id)
                ->first();

                if (!$existing){
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
    }
}
