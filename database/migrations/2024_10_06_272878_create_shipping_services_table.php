<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('shipping_services', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('carrier_id')->unsigned();
      $table->bigInteger('parcel_type_id')->unsigned();
      $table->bigInteger('region_id')->unsigned();
      $table->boolean('weekend_shipping');
      $table->float('price');
      $table->timestamps();

      $table->foreign('carrier_id')->references('id')->on('carriers');
      $table->foreign('parcel_type_id')->references('id')->on('parcel_types');
      $table->foreign('region_id')->references('id')->on('regions');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('shipping_services');
  }
};
