<?php

namespace Tests\Unit\Repositories\Shipping;

use Carbon\Carbon;
use Domain\Shipping\Repositories\ShippingServiceViewRepository;
use Domain\Shipping\Types\ParcelTypes;
use Domain\Shipping\Types\Regions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ShippingServiceViewRepositoryTest extends TestCase {

  private readonly string $table;
  private readonly Carbon $past_weekend_date;
  private readonly Carbon $future_weekend_date;
  private readonly ShippingServiceViewRepository $shippingServiceViewRepository;

  protected function setUp(): void {
    parent::setUp();
    $this->seed();
    $this->table = 'shipping_services_view';
    $this->past_weekend_date = Carbon::parse('2024-10-05');
    $this->future_weekend_date = Carbon::now()->nextWeekendDay();
    $this->shippingServiceViewRepository = app()->make(ShippingServiceViewRepository::class);
  }

  public function testAllShippingServicesArePresentInDatabase(): void {
    $this->assertEquals(25, DB::table($this->table)->count());
  }

  public function testGetShippingServicesWithoutFilters(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->select('id')
      ->pluck('id')
      ->toArray();


    $services = $this->shippingServiceViewRepository
      ->getShippingServices(null, null, null)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testGetShippingServicesWithRegionFilter(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->where('region', Regions::NL->value)
      ->select('id')
      ->pluck('id')
      ->toArray();

    $services = $this->shippingServiceViewRepository
      ->getShippingServices(null, Regions::NL->value, null)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testGetShippingServicesWithParcelTypeFilter(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->where('parcel_type', ParcelTypes::STANDARD->value)
      ->select('id')
      ->pluck('id')
      ->toArray();

    $services = $this->shippingServiceViewRepository
      ->getShippingServices(null, null, ParcelTypes::STANDARD->value)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testGetShippingServicesWithDateFilter(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->where('weekend_shipping', true)
      ->select('id')
      ->pluck('id')
      ->toArray();

    $services = $this->shippingServiceViewRepository
      ->getShippingServices($this->future_weekend_date, null, null)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testGetShippingServicesWithDateFilterShouldIgnorePastDate(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->select('id')
      ->pluck('id')
      ->toArray();

    $services = $this->shippingServiceViewRepository
      ->getShippingServices($this->past_weekend_date, null, null)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testGetShippingServicesWithRegionAndParcelTypeFilter(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->where('parcel_type', ParcelTypes::MAILBOX->value)
      ->where('region', Regions::EU->value)
      ->select('id')
      ->pluck('id')
      ->toArray();

    $services = $this->shippingServiceViewRepository
      ->getShippingServices(null, Regions::EU->value, ParcelTypes::MAILBOX->value)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testGetShippingServicesWithAllFilters(): void {
    $this->expectsDatabaseQueryCount(2);

    $expected_services = DB::table($this->table)
      ->where('parcel_type', ParcelTypes::MAILBOX->value)
      ->where('weekend_shipping', true)
      ->where('region', Regions::EU->value)
      ->select('id')
      ->pluck('id')
      ->toArray();

    $services = $this->shippingServiceViewRepository
      ->getShippingServices($this->future_weekend_date, Regions::EU->value, ParcelTypes::MAILBOX->value)
      ->pluck('id')
      ->toArray();

    $this->assertEquals($expected_services, $services);
  }

  public function testRefreshViewShouldCallDbFacade(): void {
    DB::partialMock()
      ->shouldReceive('statement')
      ->once()
      ->with("REFRESH MATERIALIZED VIEW CONCURRENTLY shipping_services_view");

    $this->shippingServiceViewRepository->refreshView();
  }

}
