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
     *      path="/api/chismes",
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
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(),
     *      )
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
     * @OA\Post(
     *      path="/api/chismes",
     *      tags={"Chismes"},
     *      operationId="createChisme",
     *      security={"bearerAuth": {}},
     *      @OA\RequestBody(ref="#/components/requestBodies/Chisme"),
     *      @OA\Response(
     *          response=201,
     *          description="Chisme created",
     *          @OA\JsonContent(ref="#/components/schemas/ChismeResource")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *          @OA\JsonContent(),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(),
     *      )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:60'],
            'content' => ['required', 'string']
        ]);

        $args = $request->all();
        $args['author_id'] = $request->user()->id;
        $chisme = Chismes::create($args);
        return new ChismeResource($chisme);
    }

    /**
     * @OA\Get(
     *      path="/api/chismes/{id}",
     *      tags={"Chismes"},
     *      operationId="getChisme",
     *      security={"bearerAuth": {}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ChismeResource"))
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(),
     *      )
     * )
     */
    public function show(Request $request, string $id)
    {
        return Chismes::get($id);
    }

}
