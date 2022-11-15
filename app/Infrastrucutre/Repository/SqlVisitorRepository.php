<?php

namespace App\Infrastrucutre\Repository;

use App\Core\Domain\Models\Url;
use App\Core\Domain\Models\Visitor\Visitor;
use Illuminate\Support\Facades\DB;
use App\Core\Domain\Repository\VisitorRepositoryInterface;

class SqlVisitorRepository implements VisitorRepositoryInterface {

  public function persist(Visitor $visitor): void {
    // Update columns in database

      $visit = $this->countVisit($visitor->getUrl());

      DB::table('visitor')->where('url', $visitor->getUrl())->update([
        'visits' => $visit+1
      ]);

  }

  public function create(Visitor $visitor): void {
    // Insert columns in database

      DB::table('visitor')->insert([
        'url' => $visitor->getUrl(),
        'name' => $visitor->getName(),
        'visits' => 0
      ]);
  }


  public function find(int $id): ?Visitor {
    $row = DB::table('visitor')->where('id', $id)->first();

    if (!$row) return null;

    return $this->constructFromRow($row);
  }

  public function findByUrl(string $url): ?Visitor {
    $row = DB::table('visitor')->where('url', $url)->first();

    if (!$row) return null;

    return $this->constructFromRow($row);
  }

  private function countVisit(string $url) : int {
    $row = DB::table('visitor')->where('url', $url)->first();
    if (!$row) return null;

    return $row->visits;
  }

  private function constructFromRow($row): Visitor {
    return new Visitor(
      $row->url,
      $row->name
    );
  }

}