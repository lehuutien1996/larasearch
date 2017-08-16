<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = "articles";

    protected $fillable = [
        "title", "body",
    ];

    protected $casts = [
        "tags" => "json",
    ];

}
