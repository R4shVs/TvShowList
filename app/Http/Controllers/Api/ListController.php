<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditTvShowOnListRequest;
use App\Http\Requests\StoreTvShowOnListRequest;
use App\Http\Resources\TvShowOnListResource;
use App\Models\TvShow;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(Request $request){
        $user = $request->user();

        $query = $user->tvShows();

        if($request->filled('title')){
            $title = $request->query('title');

            $query = $query->whereRaw("title SOUNDS LIKE ?",[$title])
            ->orWhere('title', 'LIKE', '%'.$title.'%');
        }

        if($request->filled('genre')){
            $genre = $request->query('genre');

            $query = $query->with('genres')
            ->whereHas('genres', function($q) use($genre){
                $q->where('genre', '=', $genre);
            });
        }

        if($request->filled('rating')){
            $vote_average = $request->query('rating');
            $query = $query->where('vote_average', '>=', $vote_average);
        }

        if($request->filled('priority')){
            $priority = $request->query('priority');
            $query = $query->wherePivot('priority', '>=', $priority);
        }
        
        $results = TvShowOnListResource::collection($query->paginate(10));

        $response = [
            'page' => $results->currentPage(),
            'results' => $results,
            'total_pages' => $results->lastPage(),
            'total_results' => $results->total(),
        ];

        return response()->json($response, 200);
    }

    public function store(TvShow $tvShow, StoreTvShowOnListRequest $request){
        $user = $request->user();

        if($user->tvShows()->where('id', $tvShow->id)->exists()){
            $response = [
                'success' => false,
                'status_message' =>"The tv show is already in the list.",
            ];
            
            return response()->json($response, 409);
        }
        
        $priority = $request->query('priority');

        $user->tvShows()->attach($tvShow->id, ['priority' => $priority]);

       // $user = User::with('tvShows')->where('id', $user->id)->get();
        
        $response = [
            'success' => true,
            'status_message' =>"Tv show added.",
        ];

        return response()->json($response, 200);
    }

    public function update(TvShow $tvShow, EditTvShowOnListRequest $request){
        $user = $request->user();

        if(!$user->tvShows()->where('id', $tvShow->id)->exists()){
            $response = [
                'success' => false,
                'status_message' =>"The tv show isn't in the list.",
            ];
            
            return response()->json($response, 409);
        }

        $priority = $request->query('priority');
        
        $user->tvShows()->updateExistingPivot($tvShow->id, ['priority' => $priority]);
        
        $response = [
            'success' => true,
            'status_message' =>"Priority updated.",
        ];

        return response()->json($response, 200);
    }

    public function destroy(TvShow $tvShow, Request $request){
        $user = $request->user();

        if(!$user->tvShows()->where('id', $tvShow->id)->exists()){
            $response = [
                'success' => false,
                'status_message' =>"The tv show isn't in the list.",
            ];
            
            return response()->json($response, 409);
        }

        $user->tvShows()->detach($tvShow->id);
        
        $response = [
            'success' => true,
            'status_message' =>"Tv show removed from the list.",
        ];

        return response()->json($response, 200);
    }
}
