<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Domain\Shipping\Types\Carriers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrierSeeder extends Seeder {

  private readonly string $table;
  private readonly string $date_time;

  public function __construct() {
    $this->table = 'carriers';
    $this->date_time = Carbon::now();
  }

  public function run(): void {
    DB::table($this->table)->insert([
      [
        'name' => Carriers::POSTNL->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => Carriers::DHL->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => Carriers::DPD->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => Carriers::UPS->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);
  }

}
