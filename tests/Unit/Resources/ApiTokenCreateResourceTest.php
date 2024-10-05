<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\Users\ApiTokenCreateResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class ApiTokenCreateResourceTest extends TestCase {

  public function testApiTokenCreateResourceData(): void {
    $token = 'api_token';
    $expiry_date = Carbon::now()->addHour();
    $resource = new ApiTokenCreateResource($token, $expiry_date);

    $expected = [
      'token' => $token,
      'expires_at' => $expiry_date,
    ];

    $this->assertEquals($expected, $resource->toArray(new Request()));
  }

}
