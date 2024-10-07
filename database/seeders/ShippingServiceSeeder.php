<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Domain\Shipping\Models\Carrier;
use Domain\Shipping\Models\ParcelType;
use Domain\Shipping\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingServiceSeeder extends Seeder {

  private readonly string $table;
  private readonly string $date_time;
  private readonly Collection $carriers;
  private readonly Collection $regions;
  private readonly Collection $parcel_types;

  public function __construct() {
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
  }

  private function seedPostNLShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', CarrierSeeder::$postnl)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => true,
        'price' => 6.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => true,
        'price' => 3.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$pallet)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => false,
        'price' => 26.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => true,
        'price' => 7.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => true,
        'price' => 4.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$eu)->id,
        'weekend_shipping' => true,
        'price' => 10.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$row)->id,
        'weekend_shipping' => false,
        'price' => 13.95,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

  private function seedDHLShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', CarrierSeeder::$dhl)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => true,
        'price' => 7.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => true,
        'price' => 4.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => true,
        'price' => 8.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => true,
        'price' => 5.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$eu)->id,
        'weekend_shipping' => false,
        'price' => 10.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$row)->id,
        'weekend_shipping' => false,
        'price' => 12.45,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

  private function seedDPDShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', CarrierSeeder::$dpd)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => true,
        'price' => 7.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => false,
        'price' => 4.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$pallet)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => true,
        'price' => 21.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => true,
        'price' => 8.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => false,
        'price' => 5.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$pallet)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => true,
        'price' => 23.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$eu)->id,
        'weekend_shipping' => false,
        'price' => 10.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$standard)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$row)->id,
        'weekend_shipping' => false,
        'price' => 12.75,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

  private function seedUPSShippingServices(): void {
    $carrier_id = $this->carriers->firstWhere('name', CarrierSeeder::$ups)->id;

    DB::table($this->table)->insert([
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$nl)->id,
        'weekend_shipping' => false,
        'price' => 4.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$be)->id,
        'weekend_shipping' => false,
        'price' => 5.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$eu)->id,
        'weekend_shipping' => false,
        'price' => 6.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'carrier_id' => $carrier_id,
        'parcel_type_id' => $this->parcel_types->firstWhere('name', ParcelTypeSeeder::$mailbox)->id,
        'region_id' => $this->regions->firstWhere('name', RegionSeeder::$row)->id,
        'weekend_shipping' => false,
        'price' => 8.25,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

}
