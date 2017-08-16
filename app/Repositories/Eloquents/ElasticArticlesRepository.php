<?php

namespace App\Repositories\Eloquents;

use App\Article;
use App\Repositories\Contracts\RepositoryInterface;
use Elasticsearch\Client as ElasticSearch;
use Illuminate\Support\Collection;

class ElasticArticlesRepository implements RepositoryInterface
{

    protected $elasticSearch;

    public function __construct(ElasticSearch $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch;
    }

    public function search(string $query = "")
    {
        $items = $this->searchOnElasticSearch($query);
        return $this->buildCollection($items);
    }

    protected function searchOnElasticSearch($query)
    {
        $items = $this->elasticSearch->search([
            'index' => 'acme',
            'type' => 'articles',
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => $query,
                    ],
                ],
            ],
        ]);
        return $items;
    }

    protected function buildCollection($items)
    {
        $result = $items['hits']['hits'];
        return Collection::make(array_map(function ($item) {
            $article = new Article();
            $article->newInstance($item["_source"], true);
            $article->setRawAttributes($item["_source"], true);
            return $article;
        }, $result));
    }

}
