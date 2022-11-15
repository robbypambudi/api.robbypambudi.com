<?php
namespace App\Core\Domain\Repository;

use App\Core\Domain\Models\Url;
use App\Core\Domain\Models\Visitor\Visitor;

interface VisitorRepositoryInterface
{
    public function persist(Visitor $visitor): void;
    
    public function create(Visitor $visitor): void;

    public function find(int $id): ?Visitor;

    public function findByUrl(string $url): ?Visitor;

}