<?php

namespace App\Jobs;

use App\Models\TvShow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PopulateTvShowTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tv_show_list;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tv_show_list)
    {
        $this->tv_show_list = $tv_show_list;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->tv_show_list as $tv_show){
            TvShow::firstOrCreate(
                ["tmdb_id" => $tv_show['id']],
                ["title" => $tv_show['name']]
            );
        }
    }
}
