<?php

namespace App\Http\Resources\Shipping;

use Domain\Shipping\Models\ShippingServiceView;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingServicesIndexResource extends JsonResource {

  public function __construct(private readonly ShippingServiceView $shippingService) {
    parent::__construct($this);
  }

  public function toArray($request) {
    return [
      'carrier' => $this->shippingService->carrier,
      'parcel_type' => $this->shippingService->parcel_type,
      'region' => $this->shippingService->region,
      'weekend_shipping' => $this->shippingService->weekend_shipping,
      'price' => $this->shippingService->price,
    ];
  }

}
