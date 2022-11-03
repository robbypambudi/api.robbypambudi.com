<?php
namespace App\Core\Domain\Models;

use Illuminate\Support\Facades\Validator;

class Url
{
    private string $url;

    public function __construct(string $url)
    {
        // Validate URL
        Validator::make(
            [
                'url' => $url
            ],
            [
                'url' => 'url'
            ])->validate();
        $this->url = $url;

    }

    public function toString(): string
    {
        return $this->url;
    }
}
