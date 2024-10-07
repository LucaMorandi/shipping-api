<?php

namespace Feature\Endpoints\Shipping;

use App\Http\Resources\Shipping\ShippingServicesIndexResource;
use Database\Factories\UserFactory;
use Database\Seeders\UserSeeder;
use Domain\Shipping\Repositories\ShippingServiceViewRepository;
use Domain\Shipping\Types\ParcelTypes;
use Domain\Shipping\Types\Regions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShippingServiceControllerIndexTest extends TestCase {

  private readonly string $table;
  private readonly string $endpoint;

  protected function setUp(): void {
    parent::setUp();

    $this->seed(UserSeeder::class);
    $this->table = 'shipping_services_view';
    $this->endpoint = 'api/shipping/services';

    Sanctum::actingAs(UserFactory::new()->create(), ['view:shipping-services']);
  }

  public function testEndpointHasCorrectMiddleware(): void {
    $route = $this->get_route('GET', $this->endpoint);
    $this->assertTrue($this->hasMiddleware($route, 'auth:sanctum'));
    $this->assertTrue($this->hasMiddleware($route, 'abilities:view:shipping-services'));
  }

  public function testApiTokenPermissionSanityCheck(): void {
    Sanctum::actingAs(UserFactory::new()->create());

    $response = $this->getJson($this->endpoint);
    $response->assertForbidden();
  }

  public function testEndpointCallsShippingServiceViewRepository(): void {
    $services = DB::table($this->table)
      ->where('region', Regions::NL->value)
      ->get()
      ->except('id');

    $this->partialMock(
      ShippingServiceViewRepository::class,
      fn($mock) => $mock->shouldReceive('getShippingServices')
        ->withArgs([null, Regions::NL->value, null])
        ->andReturn($services),
    );

    $response = $this->json('GET', $this->endpoint, ['region' => Regions::NL->value]);
    $response->assertOk();
  }

  public function testEndpointReturnsShippingServicesIndexResourceCollection(): void {
    $response = $this->json('GET', $this->endpoint, ['region' => Regions::NL->value]);
    $response->assertOk();

    $originalContent = $response->getOriginalContent();

    $this->assertInstanceOf(Collection::class, $originalContent);

    foreach ($originalContent->toArray() as $item) {
      $this->assertInstanceOf(ShippingServicesIndexResource::class, $item);
    }
  }

  public function testEndpointRequestWithRegionIsValid(): void {
    $response = $this->json('GET', $this->endpoint, ['region' => Regions::NL->value]);
    $response->assertOk();
  }

  public function testEndpointRequestWithParcelTypeIsValid(): void {
    $response = $this->json('GET', $this->endpoint, ['parcel_type' => ParcelTypes::STANDARD->value]);
    $response->assertOk();
  }

  public function testEndpointRequestWithDateIsValid(): void {
    $response = $this->json('GET', $this->endpoint, ['date' => '2024-10-05']);
    $response->assertOk();
  }

  public function testEndpointInvalidRequest(): void {
    $response = $this->getJson($this->endpoint);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['date', 'region', 'parcel_type']);
  }

}
