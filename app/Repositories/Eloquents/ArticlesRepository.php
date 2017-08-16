<?php

namespace App\Repositories\Eloquents;

use App\Article;
use App\Repositories\Contracts\RepositoryInterface;

class ArticlesRepository implements RepositoryInterface
{

    public function search(string $query = "")
    {
        return Article::where("body", "like", "%{$query}%")
            ->orWhere("title", "like", "%{$query}%")
            ->get();
    }

}
