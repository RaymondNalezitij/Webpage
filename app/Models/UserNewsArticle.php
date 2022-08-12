<?php

namespace App\Models;

class UserNewsArticle
{
    private string $title;
    private string $description;
    private string $imgLink;
    private string $url;
    private string $createdAt;

    public function __construct(string $title, string $description, string $imgLink, string $url, string $createdAt)
    {
        $this->title = $title;
        $this->description = $description;
        $this->imgLink = $imgLink;
        $this->url = $url;
        $this->createdAt = $createdAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImgLink(): string
    {
        return $this->imgLink;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

}