<?php

namespace Domain\Shipping\Repositories;

use Carbon\Carbon;
use Domain\Shipping\Interfaces\ShippingServiceViewRepositoryInterface;
use Domain\Shipping\Models\ShippingServiceView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ShippingServiceViewRepository implements ShippingServiceViewRepositoryInterface {

  public function getShippingServices(
    Carbon | null $date,
    string | null $region,
    string | null $parcel_type,
  ): Collection {

    return ShippingServiceView::query()
      ->when($parcel_type, fn(Builder $query, string $parcel_type) =>
        $query->where('parcel_type', $parcel_type)
      )
      ->when($region, fn(Builder $query, string $region) =>
        $query->where('region', $region)
      )
      ->when($date, fn(Builder $query, Carbon $date) =>
        $query->when(($date->isToday() || $date->isFuture()) && $date->isWeekend(), fn(Builder $query) =>
          $query->where('weekend_shipping', true)
        )
      )
      ->get();
  }

  public function refreshView(): void {
    DB::statement("REFRESH MATERIALIZED VIEW CONCURRENTLY shipping_services_view");
  }

}
