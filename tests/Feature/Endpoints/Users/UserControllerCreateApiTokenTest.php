<?php

namespace Tests\Feature\Endpoints\Users;

use App\Http\Resources\Users\ApiTokenCreateResource;
use Database\Seeders\UserSeeder;
use Domain\Users\Models\User;
use Domain\Users\Repositories\UserRepository;
use Tests\TestCase;

class UserControllerCreateApiTokenTest extends TestCase {

  private readonly string $endpoint;
  private readonly array $credentials;

  protected function setUp(): void {
    parent::setUp();

    $this->seed();
    $this->endpoint = 'api/sanctum/token';

    $this->credentials = [
      'email' => UserSeeder::$email,
      'password' => UserSeeder::$password,
      'device_name' => 'webshop_server',
    ];
  }

  public function testEndpointHasCorrectMiddleware(): void {
    $route = $this->get_route('POST', $this->endpoint);
    $this->assertTrue($this->hasMiddleware($route, 'throttle:30,1'));
  }

  public function testEndpointCallsUserRepository(): void {
    $user = User::firstWhere('email', UserSeeder::$email);

    $this->partialMock(
      UserRepository::class,
      fn($mock) => $mock->shouldReceive('getUserByEmail')->withArgs([$user->email])->andReturn($user),
    );

    $response = $this->postJson($this->endpoint, $this->credentials);
    $response->assertOk();
  }

  public function testEndpointReturnsApiTokenCreateResource(): void {
    $response = $this->postJson($this->endpoint, $this->credentials);
    $response->assertOk();
    $this->assertInstanceOf(ApiTokenCreateResource::class, $response->getOriginalContent());
  }

  public function testEmptyRequestIsInvalid(): void {
    $response = $this->post($this->endpoint, []);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['email', 'password', 'device_name']);
  }

  public function testRequestWithoutEmailIsInvalid(): void {
    [ 'password' => $password, 'device_name' => $device_name ] = $this->credentials;

    $response = $this->post($this->endpoint, compact('password', 'device_name'));
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('email');
  }

  public function testRequestWithIncorrectEmailIsInvalid(): void {
    $updated_credentials = [...$this->credentials, 'email' => 'wrong@example.com'];

    $response = $this->post($this->endpoint, $updated_credentials);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['email', 'password']);
  }

  public function testRequestWithoutPasswordIsInvalid(): void {
    [ 'email' => $email, 'device_name' => $device_name ] = $this->credentials;

    $response = $this->post($this->endpoint, compact('email', 'device_name'));
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('password');
  }

  public function testRequestWithIncorrectPasswordIsInvalid(): void {
    $updated_credentials = [...$this->credentials, 'password' => 'wrong'];

    $response = $this->post($this->endpoint, $updated_credentials);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['email', 'password']);
  }

  public function testRequestWithoutDeviceNameIsInvalid(): void {
    [ 'email' => $email, 'password' => $password ] = $this->credentials;

    $response = $this->post($this->endpoint, compact('email', 'password'));
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('device_name');
  }

}
