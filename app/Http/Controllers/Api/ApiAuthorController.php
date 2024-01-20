<?php

namespace App\Http\Controllers\Api;

use App\Contexts\Authors;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;

class ApiAuthorController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/authors",
     *      tags={"Authors"},
     *      operationId="getAuthors",
     *      security={"bearerAuth": {}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/AuthorResource")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(),
     *      )
     * )
     */
    public function index(Request $request)
    {
        $authors = Authors::getAll(with: ['chismes', 'authorReceivedComments']);
        return AuthorResource::collection($authors);
    }


    /**
     * @OA\Get(
     *      path="/api/authors/{id}",
     *      tags={"Authors"},
     *      operationId="getAuthor",
     *      security={"bearerAuth": {}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true
     *      ),
    *       @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AuthorResource"))
     *      ),
     * )
     */
    public function show(Request $request, string $id)
    {
        $author = Authors::get($id, with: ['chismes', 'authorReceivedComments']);
        return new AuthorResource($author);
    }
}
