<?php

namespace App\Core\Application\Service\Visitor;

use App\Core\Domain\Models\Url;
use App\Core\Domain\Models\Visitor\Visitor;
use App\Exceptions\UserException;
use App\Core\Domain\Repository\VisitorRepositoryInterface;

class VisitorService {

  private VisitorRepositoryInterface $visitor_repository;

  public function __construct(VisitorRepositoryInterface $visitor_repository) {
    $this->visitor_repository = $visitor_repository;
  }

  public function execute(VisitorRequest $request) {

    $find = $this->visitor_repository->findByUrl($request->getUrl());

    if (!$find) {
      throw new UserException('Url Not Found!', 2001, 404);
    }
    $vistor = Visitor::create($request->getUrl(), $find->getName());

    $this->visitor_repository->persist($vistor);

  }

  // New Visitor
  public function visitor(VisitorRequest $request) {

    $find = $this->visitor_repository->findByUrl($request->getUrl());

    if ($find) {
      throw new UserException('Url Already Exists!', 2002, 400);
    }

    $vistor = Visitor::create($request->getUrl(), $request->getName());

    $this->visitor_repository->create($vistor);

  }

}