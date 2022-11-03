<?php

namespace App\Core\Application\Service\UrlShortener;

class UrlShortenerRequest
{
    private string $url;
    private string $short_url;

    /**
     * @param string $url
     */
    public function __construct(string $url, string $short_url)
    {
        $this->url = $url;
        $this->short_url = $short_url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getShortUrl(): string
    {
        return $this->short_url;
    }
}