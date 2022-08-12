<?php

namespace App\Services;

use Doctrine\DBAL\Exception;

class StoreNewsArticleService
{
    /** @throws Exception */
    public function execute()
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

        var_dump($_POST);
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