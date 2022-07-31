<?php

namespace App\Services;

class StoreNewsArticleService
{
    public function execute(): void
    {
        $handle = fopen("app/Repositories/UserArticle.csv", "a");
        fputcsv($handle, $_POST, ',', " ", " ", ";");
        fclose($handle);

        header('Location: /');
    }
}