<?php

namespace foonoo\plugins\photo_a_day\photo_a_day;

use foonoo\Plugin;
use foonoo\events\PluginsInitialized;
use foonoo\events\SiteWriteStarted;
use foonoo\sites\SiteFactoryInterface;
use foonoo\sites\AbstractSite;


class PhotoADayPlugin extends Plugin implements SiteFactoryInterface
{
    public function getEvents() 
    {
        return [
            PluginsInitialized::class => fn (PluginsInitialized $event) => $event->getSiteTypeRegistry()->register($this, "photo-a-day"),
            SiteWriteStarted::class => fn (SiteWriteStarted $event) => $event->getThemeManager()->prependToThemePath(__DIR__ . "/themes")
        ];
    }

    public function create() : AbstractSite
    {
        return new PhotoADaySite();
    }
}