<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="My API", version="1.0")
 * @OA\Get(
 *     path="/",
 *     description="Home page",
 *     @OA\Response(response="default", description="Welcome page")
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successWithData($data): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data,
            ]
        );
    }

    protected function success(): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
            ]
        );
    }
}
