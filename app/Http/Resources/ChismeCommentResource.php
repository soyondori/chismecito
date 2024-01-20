<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ChismeCommentResource
 * 
 * @OA\Schema(
 *      title="Chisme Comment",
 *      description="Chisme comment model",
 *      required={"id", "content", "author_id", "chisme_id"},
 *      @OA\XML(
 *          name="Chisme Comment"
 *      ),
 * 
 *      @OA\Property(property="id", type="string"),
 *      @OA\Property(property="content", type="string"),
 *      @OA\Property(property="author_id", type="string"),
 *      @OA\Property(property="chisme_id", type="string")
 * )
 */
class ChismeCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'content' => $this->content,
            'author_id' => $this->author_id,
            'chisme_id' => $this->chisme_id,
            'created_at' => $this->created_at,
        ];
    }
}
