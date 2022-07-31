<?php

namespace App\Models;

class NewsCollection
{
    private array $news = [];

    public function __construct(array $news)
    {
        foreach ($news as $newsArticle) {
            $this->add($newsArticle);
        }
    }

    private function add(NewsArticle $newsArticle): void
    {
        $this->news[] = $newsArticle;
    }

    public function getAll(): array
    {
        return $this->news;
    }
}