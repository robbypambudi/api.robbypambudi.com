<?php

namespace App\Http\Controllers;

use App\Core\Application\Service\Visitor\VisitorRequest;
use App\Core\Application\Service\Visitor\VisitorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visitor(Request $request, VisitorService $service)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $url = $request->get('url');

        $input = new VisitorRequest($url);
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

    public function createVisitor(Request $request, VisitorService $service){
        $request->validate([
            'url' => 'required|url',
            'name' => 'required|string',
        ]);

        $input = new VisitorRequest(
            $request->get('url'),
            $request->get('name')
        );

        DB::beginTransaction();
        try {
            $service->visitor($input);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $this->success();
    }
}
