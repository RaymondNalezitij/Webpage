<?php

namespace App\Services;

use App\Models\NewsCollection;
use App\Repositories\NewsApiRepository;
use App\Repositories\RepositoryInterface;

class DisplayAllNewsService
{
    private RepositoryInterface $newsRepository;

    public function __construct()
    {
        $this->newsRepository = new NewsApiRepository();
    }

    public function execute(string $cattegory): NewsCollection
    {
        return $this->newsRepository->getAll($cattegory);
    }
}