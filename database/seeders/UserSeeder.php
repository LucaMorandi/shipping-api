<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

  private readonly string $table;
  private readonly string $date_time;

  public static string $name = 'webshop';
  public static string $email = 'webshop@example.com';
  public static string $password = 'password';

  public function __construct() {
    $this->table = 'users';
    $this->date_time = Carbon::now();
  }

  public function run(): void {
    DB::table($this->table)->insert([
      'name' => self::$name,
      'email' => self::$email,
      'password' => Hash::make(self::$password),
      'created_at' => $this->date_time,
      'updated_at' => $this->date_time,
    ]);
  }

}
