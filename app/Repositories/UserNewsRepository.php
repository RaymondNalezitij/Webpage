<?php

namespace App\Repositories;

use App\Models\UserNewsArticle;

class UserNewsRepository
{
    public function getAll(): array
    {
        $userArticles = explode(";", file_get_contents('./UserArticle.csv'));
        array_pop($userArticles);

        foreach ($userArticles as $data) {
            $data = explode(",", $data);
            $userNews[] = new UserNewsArticle(
                $data[0],
                $data[1],
            );
        }

        return $userNews;
    }
}