<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

  public function up(): void {
    DB::statement("
      CREATE MATERIALIZED VIEW shipping_services_view as
        SELECT
          shipping_services.id,
          carriers.name as carrier,
          parcel_types.name as parcel_type,
          regions.name as region,
          shipping_services.weekend_shipping,
          shipping_services.price
        FROM shipping_services
          INNER JOIN carriers ON carriers.id = shipping_services.carrier_id
          INNER JOIN parcel_types ON parcel_types.id = shipping_services.parcel_type_id
          INNER JOIN regions ON regions.id = shipping_services.region_id
        ORDER BY shipping_services.id ASC
    ");

    DB::statement("CREATE UNIQUE INDEX shipping_services_view_pkey ON shipping_services_view (id)");
  }

  public function down(): void {
    DB::statement("DROP MATERIALIZED VIEW shipping_services_view");
  }

};
