<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * 
 * @OA\Schema(
 *      title="User",
 *      description="User model",
 *      required={"id", "name", "email"},
 *      @OA\XML(
 *          name="User"
 *      ),
 * 
 *      @OA\Property(property="id", type="string"),
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="email", type="string")
 * )
 */
class UserResource extends JsonResource
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
            'name'=> $this->id,
            'email'=> $this->id
        ];
    }
}
