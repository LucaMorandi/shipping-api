<?php

namespace Tests\Unit\Repositories;

use Database\Seeders\UserSeeder;
use Domain\Users\Repositories\UserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase {

  private readonly UserRepository $userRepository;

  protected function setUp(): void {
    parent::setUp();
    $this->seed(UserSeeder::class);
    $this->userRepository = app()->make(UserRepository::class);
  }

  public function testUserIsPresentInDatabase(): void {
    $this->assertDatabaseHas('users', ['email' => UserSeeder::$email]);
  }

  public function testGetUserByEmailShouldReturnUser(): void {
    $this->expectsDatabaseQueryCount(1);

    $user = $this->userRepository->getUserByEmail(UserSeeder::$email);

    $this->assertEquals(UserSeeder::$email, $user->email);
    $this->assertEquals(UserSeeder::$name, $user->name);
  }

}
