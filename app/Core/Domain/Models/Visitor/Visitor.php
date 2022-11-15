<?php

namespace App\Core\Domain\Models\Visitor;

use App\Core\Domain\Models\Url;

class Visitor {

  private string $url;
  private string $name;

  public function __construct ( string $url, string $name) {
    $this->url = $url;
    $this->name = $name;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getUrl(): string {
    return $this->url;
  }

  public function getName(): string {
    return $this->name;
  }

  public static function create(string $url, string $name): self {
    return new self(
      $url,
      $name
    );
  }

}