<?php

namespace App\Controllers;

use App\Repositories\WeatherApiRepository;
use App\Services\DisplayAllNewsService;
use App\View;

class NewsController
{
    private DisplayAllNewsService $newsService;
    private WeatherApiRepository $weatherApiRepository;

    public function __construct(
        DisplayAllNewsService $newsService,
        WeatherApiRepository  $weatherApiRepository
    )
    {
        $this->newsService = $newsService;
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

}