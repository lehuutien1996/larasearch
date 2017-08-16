<?php

namespace App\Console\Commands;

use App\Article;
use Elasticsearch\Client as ElasticSearch;
use Illuminate\Console\Command;

class IndexArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all articles to Elastic Search';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ElasticSearch $elasticSearch)
    {
        parent::__construct();

        $this->elasticSearch = $elasticSearch;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $models = Article::all();

        foreach ($models as $model) {
            $this->elasticSearch->index([
                'index' => 'acme',
                'type' => 'articles',
                'id' => $model->id,
                'body' => $model->toArray(),
            ]);
        }
    }
}
