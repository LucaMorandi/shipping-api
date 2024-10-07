<?php

namespace Tests\Unit\Repositories;

use Database\Seeders\UserSeeder;
use Domain\Shipping\Models\ShippingServiceView;
use Domain\Shipping\Repositories\ShippingServiceViewRepository;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ShippingServiceViewRepositoryTest extends TestCase {

  private readonly ShippingServiceViewRepository $shippingServiceViewRepository;

  protected function setUp(): void {
    parent::setUp();
    $this->seed();
    $this->shippingServiceViewRepository = app()->make(ShippingServiceViewRepository::class);
  }

  public function testUserIsPresentInDatabase(): void {
    $this->assertDatabaseHas('users', ['email' => UserSeeder::$email]);
  }

  public function testRefreshViewShouldCallDbFacade(): void {
    DB::partialMock()
      ->shouldReceive('statement')
      ->once()
      ->with("REFRESH MATERIALIZED VIEW CONCURRENTLY shipping_services_view");

    $this->shippingServiceViewRepository->refreshView();
  }

  public function testGetShippingServicesWithoutFiltersReturnsAllResults(): void {
    $this->expectsDatabaseQueryCount(2);

    $services = $this->shippingServiceViewRepository->getShippingServices(null, null, null);

    $this->assertEquals(ShippingServiceView::query()->count(), $services->count());
  }

}
