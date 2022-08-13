<?php

namespace App\Controllers;

use App\Services\DisplayAllNewsService;
use App\Services\StoreNewsArticleService;
use App\Repositories\WeatherApiRepository;
use App\Repositories\UserNewsRepository;
use App\View;

class NewsController
{
    private DisplayAllNewsService $newsService;
    private StoreNewsArticleService $newsArticleService;
    private WeatherApiRepository $weatherApiRepository;

    public function __construct(
        DisplayAllNewsService   $newsService,
        StoreNewsArticleService $newsArticleService,
        WeatherApiRepository    $weatherApiRepository
    )
    {
        $this->newsService = $newsService;
        $this->newsArticleService = $newsArticleService;
        $this->weatherApiRepository = $weatherApiRepository;
    }

    public function index(): View
    {
        $weather = $this->weatherApiRepository->getWeather();
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
        $this->newsArticleService->execute();
    }

    public function displayUserArticles(): View
    {
        $display = new UserNewsRepository();

        return new View('UserArticles.twig', [
            'responses' => $display->post()
        ]);
    }
}