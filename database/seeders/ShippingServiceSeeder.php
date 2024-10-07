<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Domain\Shipping\Interfaces\ShippingServiceViewRepositoryInterface;
use Domain\Shipping\Models\Carrier;
use Domain\Shipping\Models\ParcelType;
use Domain\Shipping\Models\Region;
use Domain\Shipping\Types\Carriers;
use Domain\Shipping\Types\ParcelTypes;
use Domain\Shipping\Types\Regions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingServiceSeeder extends Seeder {

  private readonly string $table;
  private readonly string $date_time;
  private readonly Collection $carriers;
  private readonly Collection $regions;
  private readonly Collection $parcel_types;

  public function __construct(
    private readonly ShippingServiceViewRepositoryInterface $shippingServiceViewRepository,
  ) {
    $this->table = 'shipping_services';
    $this->date_time = Carbon::now();
    $this->carriers = Carrier::all();
    $this->parcel_types = ParcelType::all();
    $this->regions = Region::all();
  }

  public function run(): void {
    $this->seedPostNLShippingServices();
    $this->seedDHLShippingServices();
    $this->seedDPDShippingServices();
    $this->seedUPSShippingServices();

    // We have to manually refresh the materialized view after seeding the database7
    $this->shippingServiceViewRepository->refreshView();
  }

  private function seedPostNLShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', Carriers::POSTNL->value)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => true,
        'price' => 6.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => true,
        'price' => 3.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::PALLET->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => false,
        'price' => 26.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => true,
        'price' => 7.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => true,
        'price' => 4.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::EU->value)->id,
        'weekend_shipping' => true,
        'price' => 10.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::ROW->value)->id,
        'weekend_shipping' => false,
        'price' => 13.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

  private function seedDHLShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', Carriers::DHL->value)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => true,
        'price' => 7.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => true,
        'price' => 4.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => true,
        'price' => 8.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => true,
        'price' => 5.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::EU->value)->id,
        'weekend_shipping' => false,
        'price' => 10.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::ROW->value)->id,
        'weekend_shipping' => false,
        'price' => 12.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

  private function seedDPDShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', Carriers::DPD->value)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => true,
        'price' => 7.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => false,
        'price' => 4.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::PALLET->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => true,
        'price' => 21.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => true,
        'price' => 8.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => false,
        'price' => 5.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::PALLET->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => true,
        'price' => 23.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::EU->value)->id,
        'weekend_shipping' => false,
        'price' => 10.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::STANDARD->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::ROW->value)->id,
        'weekend_shipping' => false,
        'price' => 12.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

  private function seedUPSShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', Carriers::UPS->value)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::NL->value)->id,
        'weekend_shipping' => false,
        'price' => 4.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::BE->value)->id,
        'weekend_shipping' => false,
        'price' => 5.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::EU->value)->id,
        'weekend_shipping' => false,
        'price' => 6.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypes::MAILBOX->value)->id,
        'region_id' => $this->regions->firstWhere('name', Regions::ROW->value)->id,
        'weekend_shipping' => false,
        'price' => 8.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

}
