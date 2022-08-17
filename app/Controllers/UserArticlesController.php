<?php

namespace App\Controllers;

use App\Services\StoreNewsArticleService;
use App\View;

class UserArticlesController
{

    private StoreNewsArticleService $newsArticleService;

    public function __construct(
        StoreNewsArticleService $newsArticleService,
    )
    {
        $this->newsArticleService = $newsArticleService;
    }

    public function create(): View
    {
        return new View('CreateArticle.twig');
    }

    public function store(): void
    {
        $this->newsArticleService->execute();
    }

    public function displayUserArticles(): View
    {
        return new View('UserArticles.twig', [
            'responses' => $this->newsArticleService->getAll()
        ]);
    }
}