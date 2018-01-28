<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['author', 'content'];
}
