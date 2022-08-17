<?php

namespace App\Services;

use App\Repositories\UserNewsRepositoryMYSQL;
use Doctrine\DBAL\Exception;

class StoreNewsArticleService
{
    private UserNewsRepositoryMYSQL $newsRepositoryMYSQL;

    public function __construct(UserNewsRepositoryMYSQL $newsRepositoryMYSQL)
    {
        $this->newsRepositoryMYSQL = $newsRepositoryMYSQL;
    }

    public function execute(): void
    {
        $this->newsRepositoryMYSQL->store();
    }

    public function getAll(): array
    {
        return $this->newsRepositoryMYSQL->post();
    }

}