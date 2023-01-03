<?php

namespace foonoo\plugins\photo_a_day\photo_a_day;

use foonoo\sites\AbstractSite;

class PhotoADaySite extends AbstractSite
{
    public function getContent(): array
    {
        return [];
    }

    public function getType(): string
    {
        return "photo-a-day";
    }

    public function getDefaultTheme(): string
    {
        return "photos";
    }

    public function initialize(string $path, array $metaData): void
    {
        var_dump($path, $metaData);
    }

}


