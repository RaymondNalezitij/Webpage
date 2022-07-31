<?php

use App\Models\NewsArticle;

test("The program should function", function () {
    $news = new NewsArticle('Google', 'frt', 'https://google.com');

    expect($news->getTitle())->toBe('Google');
    expect($news->getDescription())->toBe('frt');
    expect($news->getUrl())->toBe('https://google.com');
});