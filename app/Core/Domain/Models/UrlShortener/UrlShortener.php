<?php
namespace App\Core\Domain\Models\UrlShortener;

use App\Core\Domain\Models\Url;

class UrlShortener {
    private UrlShortenerId $id;
    private Url $url;
    private string $short_url;
    private int $click_count;


    public function __construct(UrlShortenerId $id, Url $url, string $short_url, int $click_count = 0)
    {
        $this->id = $id;
        $this->url = $url;
        $this->short_url = $short_url;
        $this->click_count = $click_count;
    }

    public function getId(): UrlShortenerId
    {
        return $this->id;
    }

    public function getUrl(): Url
    {
        return $this->url;
    }
    
    public function getShortUrl(): string
    {
        return $this->short_url;
    }
    
    public function getClickCount(): int
    {
        return $this->click_count;
    }
    
    public function incrementClickCount(): void
    {
        $this->click_count++;
    }

    public static function create(Url $url, string $short_url): self
    {
        return new self(
            UrlShortenerId::generate(),
            $url,
            $short_url
        );
    }
}