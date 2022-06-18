<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'tmdb_id';
    }

    protected $fillable = [
        'title',
        'tmdb_id',
        'first_air_date',
        'last_air_date',
        'episode_run_time',
        'number_of_seasons',
        'number_of_episodes',
        'status',
        'vote_average',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['priority'])
            ->orderByDesc('tv_show_user.priority');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function networks()
    {
        return $this->belongsToMany(Network::class);
    }

    public function isNew(){
        return $this->created_at == $this->updated_at;
    }
    
    public function isOld(){
        $now = Carbon::now();
        $lastUpdate=Carbon::parse($this->updated_at);
        return $now->diffInDays($lastUpdate) > 0;
    }
    
}
