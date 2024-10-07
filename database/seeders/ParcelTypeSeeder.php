<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Domain\Shipping\Types\ParcelTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelTypeSeeder extends Seeder {

  private readonly string $table;
  private readonly string $date_time;

  public function __construct() {
    $this->table = 'parcel_types';
    $this->date_time = Carbon::now();
  }

  public function run(): void {
    DB::table($this->table)->insert([
      [
        'name' => ParcelTypes::STANDARD->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => ParcelTypes::MAILBOX->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => ParcelTypes::PALLET->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

}
