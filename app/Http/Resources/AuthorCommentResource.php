<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AuthorCommentResource
 * 
 * @OA\Schema(
 *      title="Author Comment",
 *      description="Author comment model",
 *      required={"id", "content", "author_id", "recipient_id"},
 *      @OA\XML(
 *          name="Author Comment"
 *      ),
 * 
 *      @OA\Property(property="id", type="string"),
 *      @OA\Property(property="content", type="string"),
 *      @OA\Property(property="author_id", type="string"),
 *      @OA\Property(property="recipient_id", type="string")
 * )
 */
class AuthorCommentResource extends JsonResource
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
            'recipient_id' => $this->recipient_id,
            'created_at' => $this->created_at,
        ];
    }
}
