<?php

namespace Domain\Users\Repositories;

use Domain\Users\Interfaces\UserRepositoryInterface;
use Domain\Users\Models\User;

class UserRepository implements UserRepositoryInterface {

  public function getUserByEmail(string $email): User | null {
    return User::where('email', $email)->first();
  }

}
