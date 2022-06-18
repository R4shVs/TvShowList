<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\TmdbRequestsTrait;
use App\Http\Requests\IndexTvShowRequest;
use App\Http\Resources\ShowTvShowResource;
use App\Http\Resources\IndexTvShowResource;
use App\Models\Network;

class TvShowController extends Controller
{
    use TmdbRequestsTrait;

    public function index(IndexTvShowRequest $request){
        $tvShow = $request->query('query');

        if(strtolower($request->query('advanced')) == 'true'){
            $response =  $this->searchShow($tvShow, $request->query('page'));
            return response()->json($response, 200);
        }

        $results = IndexTvShowResource::collection(
            TvShow::whereRaw(
                "title SOUNDS LIKE ?",[$tvShow])
            ->orWhere('title', 'LIKE', "%".$tvShow.'%')
            ->paginate(20)
        );

        $response = [
            'page' => $results->currentPage(),
            'results' => $results,
            'total_pages' => $results->lastPage(),
            'total_results' => $results->total(),
        ];

        return response()->json($response, 200);
    }

    public function show(TvShow $tvShow){
        if($tvShow->isNew() || $tvShow->isOld() ){
            $data =  $this->updateDetails($tvShow->tmdb_id);

            $tvShow->update([
                "title" => $data['title'],
                "tmdb_id" => $data['tmdb_id'],
                "first_air_date" => $data['first_air_date'],
                "last_air_date" => $data['last_air_date'],
                "episode_run_time" => $data['episode_run_time'],
                "number_of_seasons" => $data['number_of_seasons'],
                "number_of_episodes" => $data['number_of_episodes'],
                "status" => $data['status'],
                "vote_average" => $data['vote_average'],
            ]);
            $tvShow->touch();

            $genres  = $data['genres'];

            foreach($genres as $genre){
                $g_id = Genre::where('genre', $genre)->first()->id;
                $tvShow->genres()->syncWithoutDetaching($g_id);
            }
            
            $networks  = $data['networks'];

            foreach($networks as $network){
                $n_id = Network::firstOrCreate(
                    ["network" => $network]
                );

                $tvShow->networks()->syncWithoutDetaching($n_id);
            }
        }

        $results = new ShowTvShowResource($tvShow);
        
        return response()->json($results, 200);
    }    
}
