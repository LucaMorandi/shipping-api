<?php

namespace Domain\Users\Interfaces;

use Domain\Users\Models\User;

interface UserRepositoryInterface {

  public function getUserByEmail(string $email): User | null;

}
