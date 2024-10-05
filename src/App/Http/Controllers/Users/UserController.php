<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ApiTokenCreateRequest;
use App\Http\Resources\Users\ApiTokenCreateResource;
use Carbon\Carbon;
use Domain\Users\Interfaces\UserRepositoryInterface;

class UserController extends Controller {

  public function __construct(private readonly UserRepositoryInterface $userRepository) {}

  public function createApiToken(ApiTokenCreateRequest $request): ApiTokenCreateResource {
    $user = $this->userRepository->getUserByEmail($request->getEmail());
    $token = $user->createToken($request->getDeviceName())->plainTextToken;

    return new ApiTokenCreateResource($token, Carbon::now()->addHour());
  }

}
