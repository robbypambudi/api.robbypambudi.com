<?php

namespace App\Infrastrucutre\Repository;

use Illuminate\Support\Facades\DB;
use App\Core\Domain\Models\UrlShortener\UrlShortener;
use App\Core\Domain\Models\UrlShortener\UrlShortenerId;
use App\Core\Domain\Models\Url;

use App\Core\Domain\Repository\UrlShortenerInterface;

class SqlUrlShortenerRepository implements UrlShortenerInterface
{
    public function persist(UrlShortener $url_shortener): void
    {
        DB::table('url_shortener')->upsert([
            'id' => $url_shortener->getId()->toString(),
            'short_url' => $url_shortener->getShortUrl(),
            'url' => $url_shortener->getUrl()->toString(),
        ], 'id');
    }

    public function find(UrlShortenerId $id): ?UrlShortener
    {
        $row = DB::table('url_shortener')->where('id', $id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRow($row);
    }

    public function findByShortUrl(string $short_url): ?string
    {
        $row = DB::table('url_shortener')->where('short_url', $short_url)->first();

        if (!$row) return null;

        return $row->id;
    }

    private function constructFromRow($row): UrlShortener
    {
        return new UrlShortener(
            new UrlShortenerId($row->id),
            new Url($row->url),
            $row->short_url,
        );
    }

    public function incrementClickCount(UrlShortenerId $id): void
    {
        DB::table('url_shortener')->where('id', $id->toString())->increment('click_count');
    }

}

