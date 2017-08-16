<?php

namespace App\Observers;

use App\Article;
use Elasticsearch\Client as ElasticSearch;

class ElasticArticleObserver
{

    protected $elasticSearch;

    public function __construct(ElasticSearch $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch;
    }

    public function created(Article $article)
    {

        \Log::debug(print_r($article, true));

        $this->elasticSearch->index([
            'index' => 'acme',
            'type' => 'articles',
            'id' => $article->id,
            'body' => $article->toArray(),
        ]);
    }

    public function updated(Article $article)
    {
        $this->elasticSearch->index([
            'index' => 'acme',
            'type' => 'articles',
            'id' => $article->id,
            'body' => $article->toArray(),
        ]);
    }

    public function deleted(Article $article)
    {
        $this->elasticSearch->index([
            'index' => 'acme',
            'type' => 'articles',
            'id' => $article->id,
        ]);
    }

}
