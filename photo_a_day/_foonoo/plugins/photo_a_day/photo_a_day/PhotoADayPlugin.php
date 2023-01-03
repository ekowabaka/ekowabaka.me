<?php

namespace foonoo\plugins\photo_a_day\photo_a_day;

use foonoo\Plugin;
use foonoo\events\PluginsInitialized;
use foonoo\sites\SiteFactoryInterface;
use foonoo\sites\AbstractSite;


class PhotoADayPlugin extends Plugin implements SiteFactoryInterface
{
    public function getEvents() 
    {
        return [
            PluginsInitialized::class => function(PluginsInitialized $event) {
                $event->getSiteTypeRegistry()->register($this, "photo-a-day");
            }
        ];
    }

    public function create() : AbstractSite
    {
        return new PhotoADaySite();
    }
}