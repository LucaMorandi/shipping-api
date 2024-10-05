<?php

namespace App\Http\Resources\Users;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiTokenCreateResource extends JsonResource {

  public function __construct(
      private readonly string $token,
      private readonly Carbon $expiry_date,
  ) {
    parent::__construct($this);
  }

  public function toArray($request) {
    return [
      'token' => $this->token,
      'expires_at' => $this->expiry_date,
    ];
  }

}
