<?php

namespace App\Services;

use App\Repositories\UserNewsRepository;

class DisplayAllUserArticlesService
{
    private UserNewsRepository $newsRepository;

    public function __construct()
    {
        $this->newsRepository = new UserNewsRepository();
    }

    public function execute(): array
    {
        return $this->newsRepository->getAll();
    }
}