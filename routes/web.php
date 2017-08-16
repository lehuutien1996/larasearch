<?php

use App\Repositories\Eloquents\ArticlesRepository;
use App\Repositories\Eloquents\ElasticArticlesRepository;

Route::get('/', function () {
    return App\Article::all();
});

Route::get("/search/v2", function (ElasticArticlesRepository $article) {
    $query = request('q');
    return $article->search($query);
});

Route::get('/search', function (ArticlesRepository $article) {
    $query = request('q');
    return $article->search($query);
});

Route::post('/articles', function () {
    return \App\Article::create(request(['title', 'body']));
});
