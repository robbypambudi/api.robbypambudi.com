<?php

namespace App\Core\Application\Service\UrlShortener;

use App\Core\Domain\Models\Url;
use App\Core\Domain\Repository\UrlShortenerInterface;
use App\Core\Application\Service\UrlShortener\UrlShortenerRespond;
use App\Core\Domain\Models\UrlShortener\UrlShortener;
use Exception;

class UrlShortenerService
{
    private UrlShortenerInterface $url_shortener_repository;

     /**
     * @param UrlShortenerInterface $url_shortener_repository
     */
    public function __construct(UrlShortenerInterface $url_shortener_repository)
    {
        $this->url_shortener_repository = $url_shortener_repository;
    }

     /**
     * @throws Exception
     */
    public function execute(UrlShortenerRequest $request){
        // Find if short url already exist
        $find = $this->url_shortener_repository->findByShortUrl($request->getShortUrl());
        if($find){
            throw new \Exception('Short url already exist');
        }
        $url_shortener = UrlShortener::create(new Url($request->getUrl()), $request->getShortUrl());

        $this->url_shortener_repository->persist($url_shortener);
    }

    public function getUrl(string $alias) : UrlShortenerRespond
    {
        // Find if short url already exist
        $find = $this->url_shortener_repository->findByShortUrl($alias);

        if ($find) {
            return new UrlShortenerRespond($find);
        }
        throw new \Exception('Url not found');
    }

}