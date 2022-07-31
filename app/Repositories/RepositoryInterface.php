<?php

namespace App\Repositories;

use App\Models\NewsCollection;

interface RepositoryInterface
{
    public function getAll(string $category): NewsCollection;
}