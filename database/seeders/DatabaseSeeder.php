<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  public function run(): void {
    $this->call(CarrierSeeder::class);
    $this->call(ParcelTypeSeeder::class);
    $this->call(RegionSeeder::class);
    $this->call(UserSeeder::class);

    // This seeder should run last as it relies on data from the other seeders
    $this->call(ShippingServiceSeeder::class);
  }

}
