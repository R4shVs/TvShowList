<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['genre'];
    public $timestamps = false;
    
    public function tvShows(){
        return $this->belongsToMany(TvShow::class);
    }
}
