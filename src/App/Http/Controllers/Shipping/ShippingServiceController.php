<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingServicesIndexRequest;
use App\Http\Resources\Shipping\ShippingServicesIndexResourceCollection;
use Domain\Shipping\Interfaces\ShippingServiceViewRepositoryInterface;

class ShippingServiceController extends Controller {

  public function __construct(
    private readonly ShippingServiceViewRepositoryInterface $shippingServiceViewRepository,
  ) {}

  public function index(ShippingServicesIndexRequest $request): ShippingServicesIndexResourceCollection {
    $shipping_services = $this->shippingServiceViewRepository->getShippingServices(
      $request->getDate(),
      $request->getRegion(),
      $request->getParcelType(),
    );

    return new ShippingServicesIndexResourceCollection($shipping_services);
  }

}
