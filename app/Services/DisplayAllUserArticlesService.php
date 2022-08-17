<?php

namespace App\Services;

use App\Repositories\UserNewsRepositoryMYSQL;

class DisplayAllUserArticlesService
{
    private UserNewsRepositoryMYSQL $newsRepository;

    public function __construct()
    {
        $this->newsRepository = new UserNewsRepositoryMYSQL();
    }

    public function execute(): array
    {
        return $this->newsRepository->post();
    }
}