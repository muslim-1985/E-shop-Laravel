<?php

namespace App\Jobs;

use App\Http\Helpers\Contracts\SearchEngine;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ElasticSave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $elasticIndexArray;

    public function __construct(array $elasticIndexArray)
    {
        $this->elasticIndexArray = $elasticIndexArray;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SearchEngine $searchEngine)
    {
        $searchEngine->Index($this->elasticIndexArray);
    }
}
