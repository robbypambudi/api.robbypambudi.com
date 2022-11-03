<?php

namespace App\Http\Controllers;

use App\Core\Application\Service\UrlShortener\UrlShortenerRequest;
use App\Core\Application\Service\UrlShortener\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class UrlShortenerController extends Controller
{
    public function createUrl(Request $request, UrlShortenerService $service) : JsonResponse
    {
        $request->validate([
            'url' => 'required|url',
            'short_url' => 'required|string',
        ]);

        $input = new UrlShortenerRequest($request->get('url'), $request->get('short_url'));

        DB::beginTransaction();

        try {
            $service->execute($input);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $this->success();
    }

    public function getUrl(Request $request, UrlShortenerService $service) : JsonResponse
    {
        // Query alias
        $request->validate([
            'alias' => 'required|string',
        ]);
        $alias = $request->get('alias');

        DB::beginTransaction();
        try {
            $url = $service->getUrl($alias);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->successWithData($url);
    }
}