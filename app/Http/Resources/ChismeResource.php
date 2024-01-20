<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ChismeResource
 * 
 * @OA\Schema(
 *      title="Chisme",
 *      description="Chisme model",
 *      required={"id", "title", "content", "author_id"},
 *      @OA\XML(
 *          name="Chisme"
 *      ),
 * 
 *      @OA\Property(property="id", type="string"),
 *      @OA\Property(property="title", type="string"),
 *      @OA\Property(property="content", type="string"),
 *      @OA\Property(property="author_id", type="string"),
 *      @OA\Property(
 *          property="author", 
 *          ref="#/components/schemas/UserResource"
 *      ),
 *      @OA\Property(
 *          property="comments", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/ChismeCommentResource")
 *      ),
 * )
 */
class ChismeResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $baseResource = [
            'id'=> $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author_id' => $this->author_id,
            'created_at' => $this->content,
        ];

        if ($this->author) {
            $baseResource['author'] = new UserResource($this->author);
        }

        if ($this->comments) {
            $baseResource['comments'] = ChismeCommentResource::collection($this->comments);
        }

        return $baseResource;
    }
}
