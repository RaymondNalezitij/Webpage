<?php

namespace App\Models;

class WeatherAssetFuture
{
    private string $icon;

    public function __construct(string $icon)
    {
        $this->icon = $icon;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }
}
