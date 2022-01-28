<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SignInResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'access_token' => $this->resource,
            'token_type'   => 'Bearer',
            'user'         => UserResource::make(Auth::user()),
            'expires_in'   => Auth::factory()->getTTL() * 60,
        ];
    }
}
