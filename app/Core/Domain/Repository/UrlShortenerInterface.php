<?php

namespace App\Core\Domain\Repository;
use App\Core\Domain\Models\UrlShortener\UrlShortener;
use App\Core\Domain\Models\UrlShortener\UrlShortenerId;
use App\Core\Domain\Models\Url;

interface UrlShortenerInterface
{
    public function persist(UrlShortener $url_shortener): void;

    public function find(UrlShortenerId $id): ?UrlShortener;

    public function findByShortUrl(string $short_url): ?string;
}