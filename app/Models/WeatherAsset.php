<?php

namespace App\Models;

class WeatherAsset
{
    private string $temp_c;
    private string $icon;

    public function __construct(string $temp_c, string $icon)
    {
        $this->temp_c = $temp_c;
        $this->icon = $icon;
    }

    public function getTempC(): float
    {
        return $this->temp_c;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }
}