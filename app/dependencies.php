<?php

use App\Infrastrucutre\Service\JwtManager;
use App\Core\Domain\Service\JwtManagerInterface;
use Illuminate\Contracts\Foundation\Application;
use App\Infrastrucutre\Repository\SqlUserRepository;
use App\Infrastrucutre\Repository\SqlUrlShortenerRepository;
use App\Core\Domain\Repository\UserRepositoryInterface;
use App\Core\Domain\Repository\UrlShortenerInterface;

/** @var Application $app */

// User Repository
$app->singleton(UserRepositoryInterface::class, SqlUserRepository::class);

// URL Shortener
$app->singleton(UrlShortenerInterface::class, SqlUrlShortenerRepository::class);

// JWT Manager
$app->singleton(JwtManagerInterface::class, JwtManager::class);
