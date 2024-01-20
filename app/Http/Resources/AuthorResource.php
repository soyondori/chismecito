<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AuthorResource
 * 
 * @OA\Schema(
 *      title="Author",
 *      description="Author model",
 *      required={"id", "name", "email"},
 *      @OA\XML(
 *          name="Author"
 *      ),
 * 
 *      @OA\Property(property="id", type="string"),
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="email", type="string"),
 *      @OA\Property(
 *          property="chismes", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/ChismeResource")
 *      ),
 *      @OA\Property(
 *          property="comments", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/AuthorCommentResource")
 *      ),
 * )
 */
class AuthorResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email
        ];

        if ($this->chismes) {
            $baseResource['chismes'] = ChismeResource::collection($this->chismes);
        }

        if ($this->authorReceivedComments) {
            $baseResource['comments'] = AuthorCommentResource::collection($this->authorReceivedComments);
        }

        return $baseResource;
    }
}
