<?php

namespace App\Http\Middleware;

use Symfony\Component\DomCrawler\Crawler;

class FilterIfPjax extends \Spatie\Pjax\Middleware\FilterIfPjax
{
    /**
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     * @param string                                $container
     *
     * @return string
     */
    protected function fetchContainer(Crawler $crawler, $container) : string
    {
        $content = $crawler->filter($container);

        if (!$content->count()) {
            return $crawler->html();
        }

        return $content->html();
    }
}
