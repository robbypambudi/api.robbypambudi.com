<?php

namespace App\Core\Application\Service\UrlShortener;

use JsonSerializable;

class UrlShortenerRespond implements JsonSerializable {

    private string $url;

    /**
     * @param string $short_url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function jsonSerialize(): array
    {
        return [
            'url' => $this->url
        ];
    }
}
