<?php

namespace App\Repositories;

require_once 'vendor/autoload.php';

use App\Models\NewsArticle;
use App\Models\NewsCollection;
use GuzzleHttp\Client;

class NewsApiRepository implements RepositoryInterface
{
    public function getAll(string $cattegory): NewsCollection
    {
        $client = new Client([
            'base_uri' => $_ENV['NEWS_API_URL']
        ]);

        $path = "top-headlines?country=us&category=$cattegory&apiKey=";

        $response = json_decode(
            $client->get($path . $_ENV['NEWS_API_KEY'])->getBody()->getContents()
        );

        $news = [];

        foreach ($response->articles as $data) {
            $news[] = new NewsArticle(
                (string)$data->author,
                (string)$data->title,
                (string)$data->description,
                (string)$data->url,
                (string)$data->urlToImage,
                (string)$data->publishedAt
            );
        }
        return new NewsCollection($news);
    }
}