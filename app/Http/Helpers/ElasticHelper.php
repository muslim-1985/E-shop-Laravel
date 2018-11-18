<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 18.11.18
 * Time: 17:57
 */

namespace App\Http\Helpers;
use App\Http\Helpers\Contracts\SearchEngine;
use Elasticsearch\Client;

class ElasticHelper implements SearchEngine
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function Index (array  $params)
    {
        return $this->client->index($params);
    }

    public function Delete (array $params)
    {
        return $this->client->delete($params);
    }

    public function Search (array $params)
    {
        return $this->client->search($params);
    }

}