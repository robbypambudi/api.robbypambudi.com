<?php

namespace App\Core\Application\Service\UrlShortener;

use App\Core\Domain\Models\Url;
use App\Core\Domain\Repository\UrlShortenerInterface;
use App\Core\Application\Service\UrlShortener\UrlShortenerRespond;
use App\Core\Domain\Models\UrlShortener\UrlShortener;
use App\Core\Domain\Models\UrlShortener\UrlShortenerId;
use App\Exceptions\UserException;
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
            throw new UserException("Short url already exist", 1002, 400);
        }
        $url_shortener = UrlShortener::create(new Url($request->getUrl()), $request->getShortUrl());

        $this->url_shortener_repository->persist($url_shortener);
    }

    public function getUrl(string $alias) : UrlShortenerRespond
    {
        // Find if short url already exist
        $find = $this->url_shortener_repository->findByShortUrl($alias);

        // dd($find);
        if ($find) {
            $url_shortener = $this->url_shortener_repository->find(new UrlShortenerId($find));
            $this->url_shortener_repository->incrementClickCount(new UrlShortenerId($find));
            return new UrlShortenerRespond($url_shortener->getUrl()->toString());
        }
        // Icrement the counter
        throw new UserException('Url Not Found!', 1001, 404);
    }

}