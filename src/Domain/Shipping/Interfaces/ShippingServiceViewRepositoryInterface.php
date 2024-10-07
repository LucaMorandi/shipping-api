<?php

namespace Domain\Shipping\Interfaces;

use Carbon\Carbon;
use Illuminate\Support\Collection;

interface ShippingServiceViewRepositoryInterface {

  // Alas we can't type hint backed enums and have to resort to string type instead
  public function getShippingServices(
    Carbon | null $date,
    string | null $region,
    string | null $parcel_type,
  ): Collection;

  public function refreshView(): void;

}
