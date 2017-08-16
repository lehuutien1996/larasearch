<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{

    public function search(string $query = "");

}
