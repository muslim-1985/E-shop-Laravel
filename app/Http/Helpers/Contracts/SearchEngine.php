<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 18.11.18
 * Time: 18:57
 */

namespace App\Http\Helpers\Contracts;


interface SearchEngine
{

    public function Index (array  $params);

    public function Delete (array  $params);

    public function Search (array  $params);

}