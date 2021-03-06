<?php

namespace App\Providers;

use App\Http\Helpers\Contracts\SearchEngine;
use App\Http\Helpers\ElasticHelper;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //подгружаем вначале клиент обертки эластика
        $elasticHost = [config('database.elastic.host')];
        //создаем связь с интерфейсом в сервис провайдере
        $this->app->bind(SearchEngine::class, function() use ($elasticHost)  {
            return new ElasticHelper(ClientBuilder::create()->setHosts($elasticHost)->build());
            //return new SphinxHelper(Client::class);
        });
    }
}
