<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  public function run(): void {
    $this->call(ParcelTypeSeeder::class);
    $this->call(RegionSeeder::class);
    $this->call(UserSeeder::class);
  }

}
