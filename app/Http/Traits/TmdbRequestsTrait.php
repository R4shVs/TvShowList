<?php

namespace App\Http\Traits;

use App\Jobs\PopulateTvShowTable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

trait TmdbRequestsTrait {
    public function searchShow($show_name, $page = 1) {
        $tmdb_api = env('TMDB_API_KEY');
        $url = "https://api.themoviedb.org/3/search/tv";

        $response = Http::get($url, [
            'api_key' => $tmdb_api,
            'query' => $show_name,
            'page' => $page
        ]);
        
        if(!$response->successful()){
            throw new HttpResponseException(response()->json($response, $response->status()));
        }

        $response = $response->json();
        $results = $response['results'];

        $new_tv_show_list = [];

        foreach($results as $key=>$value){
            $tv_show = [];
            $tv_show['id'] = $value['id'];
            $tv_show['name'] = $value['name'];
            $new_tv_show_list[$key] = $tv_show;
        }

        $populate = new PopulateTvShowTable($new_tv_show_list);
        $this->dispatch($populate);

        return $response;
    }

    public function updateDetails($id){
        $tmdb_api = env('TMDB_API_KEY');
        $url = "https://api.themoviedb.org/3/tv/{$id}";

        $response = Http::get($url, [
            'api_key' => $tmdb_api,
        ]);

        if(!$response->successful()){
            throw new HttpResponseException(response()->json($response, $response->status()));
        }

        $response = $response->json();
        $tv_show = [];

        $tv_show['title'] = $response['name'];
        $tv_show['tmdb_id'] = $response['id'];
        $tv_show['first_air_date'] = $response['first_air_date'];
        $tv_show['last_air_date'] = $response['last_air_date'];
        $tv_show['episode_run_time'] = (count($response['episode_run_time']) > 0) ?
            $response['episode_run_time'][0] : 0;
        $tv_show['number_of_seasons'] = $response['number_of_seasons'];
        $tv_show['number_of_episodes'] = $response['number_of_episodes'];
        $tv_show['status'] = $response['status'];
        $tv_show['vote_average'] = $response['vote_average'];
        
        $genres = [];
        
        foreach($response['genres'] as $genre){
            array_push($genres, $genre['name']);
        }
        $tv_show['genres'] = $genres;

        
        $networks = [];
        
        foreach($response['networks'] as $network){
            array_push($networks, $network['name']);
        }

        $tv_show['networks'] = $networks;


        return $tv_show;
    }
}

