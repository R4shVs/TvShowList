<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowTvShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->tmdb_id,
            'name' => $this->title,
            'first_air_date' => $this->first_air_date,
            'last_air_date' => $this->last_air_date,
            'episode_run_time' => $this->episode_run_time,
            'number_of_seasons' => $this->number_of_seasons,
            'number_of_episodes' => $this->number_of_episodes,
            'number_of_episodes' => $this->number_of_episodes,
            'status' => $this->status,
            'vote_average' => $this->vote_average,
            'genres' => $this->genres->implode('genre', ', '),
            'networks' => $this->networks->implode('network', ', '),
        ];
    }
} //format('m/d/Y')
