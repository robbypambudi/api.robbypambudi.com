<?php

namespace App\Core\Application\Service\Visitor;

use App\Core\Domain\Models\Url;

class VisitorRequest {
  private string $url;
  private ?string $name;

  public function __construct( string $url , ?string $name = null) {
    $this->url = $url;
    $this->name = $name;
  }

  public function getUrl(): string {
    return $this->url;
  }

  public function getName(): ?string {
    return $this->name;
  }

}
