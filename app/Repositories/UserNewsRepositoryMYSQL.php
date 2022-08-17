<?php

namespace App\Repositories;

use App\Models\UserNewsArticle;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class UserNewsRepositoryMYSQL
{

    private Connection $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'News',
            'user' => 'user',
            'password' => 'password',
            'host' => 'localhost',
            'driver' => 'pdo_mysql'
        ];
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }


    /** @throws Exception */
    public function post(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

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


    /** @throws Exception */
    public function store(): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->insert('news')
            ->values([
                'title' => '?',
                'description' => '?',
                'img' => '?',
                'url' => '?',
            ])
            ->setParameter(0, $_POST['Title'])
            ->setParameter(1, $_POST['Description'])
            ->setParameter(2, $_POST['img'])
            ->setParameter(3, $_POST['url'])
            ->executeQuery();

        header('Location: /');
    }
}