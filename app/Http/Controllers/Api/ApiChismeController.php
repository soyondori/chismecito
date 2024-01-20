<?php

namespace App\Http\Controllers\Api;

use App\Contexts\Chismes;
use App\Http\Resources\ChismeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiChismeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/user",
     *      tags={"Chismes"},
     *      operationId="getChismes",
     *      security={"bearerAuth": {}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/ChismeResource")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *          @OA\JsonContent(),
     *      ),
     * )
     */
    public function index()
    {
        $chismes = Chismes::getAll(
            with: ['comments', 'author']
        );

        return ChismeResource::collection($chismes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

}
