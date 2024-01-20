<?php

namespace App\Http\Resources;
/**
 * @OA\RequestBody(
 *      request="Chisme",
 *      required=true,
 *      @OA\JsonContent(
 *          @OA\Property(property="title", type="string"),
 *          @OA\Property(property="content", type="string")
 *      )
 * )
 */
class ChismeRequestBody
{
}