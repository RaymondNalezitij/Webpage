<?php

namespace App\Repositories;

use App\Models\UserNewsArticle;
use Doctrine\DBAL\Exception;

class UserNewsRepository
{
    /** @throws Exception */
    public function post()
    {
        $connectionParams = [
            'dbname' => 'News',
            'user' => 'user',
            'password' => 'password',
            'host' => 'localhost',
            'driver' => 'pdo_mysql'
        ];

        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        $queryBuilder = $conn->createQueryBuilder();

        $articles = $queryBuilder
            ->select('title, description, img, url, created_at')
            ->from('news')
            ->executeQuery();

        $userArticles = $articles->fetchAllAssociative();

        foreach ($userArticles as $data) {
            $news[] = new UserNewsArticle(
                (string)$data['title'],
                (string)$data['description'],
                (string)$data['img'],
                (string)$data['url'],
                (string)$data['created_at'],
            );
        }

        return $news;
    }
}