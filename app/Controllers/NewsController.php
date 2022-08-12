<?php

namespace App\Controllers;

use App\Repositories\UserNewsRepository;
use App\Repositories\WeatherApiRepository;
use App\Services\DisplayAllNewsService;
use App\Services\StoreNewsArticleService;
use App\View;

class NewsController
{
    private DisplayAllNewsService $newsService;

    public function __construct(DisplayAllNewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(): View
    {
        $weather = new WeatherApiRepository();
        $weather = $weather->getWeather();

        $category = $_GET['category'] ?? 'general';

        return new View('NewsOutput.twig', [
            'responses' => $this->newsService->execute($category)->getAll(),
            'weather' => $weather[0],
            'futureWeather' => $weather[1],
            'category' => ucfirst($category)
        ]);
    }

    public function create(): View
    {
        return new View('CreateArticle.twig');
    }

    public function store(): void
    {
        $store = new StoreNewsArticleService();
        $store->execute();
    }

    public function displayUserArticles(): View
    {
        $display = new UserNewsRepository();

        return new View('UserArticles.twig', [
            'responses' => $display->post()
        ]);
    }
}