<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Domain\Shipping\Types\Regions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder {

  private readonly string $table;
  private readonly string $date_time;

  public function __construct() {
    $this->table = 'regions';
    $this->date_time = Carbon::now();
  }

  public function run(): void {
    DB::table($this->table)->insert([
      [
        'name' => Regions::NL->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => Regions::BE->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => Regions::EU->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
      [
        'name' => Regions::ROW->value,
        'created_at' => $this->date_time,
        'updated_at' => $this->date_time,
      ],
    ]);

  }

}
