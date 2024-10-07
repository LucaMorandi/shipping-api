<?php

namespace Tests\Unit\Resources\Shipping;

use App\Http\Resources\Shipping\ShippingServicesIndexResource;
use Domain\Shipping\Models\ShippingServiceView;
use Illuminate\Http\Request;
use Tests\TestCase;

class ShippingServicesIndexResourceTest extends TestCase {

  protected function setUp(): void {
    parent::setUp();
    $this->seed();
  }

  public function testShippingServicesIndexResourceData(): void {
    $shipping_service = ShippingServiceView::query()->first();
    $resource = new ShippingServicesIndexResource($shipping_service);
    $expected = collect($shipping_service)->except('id')->toArray();

    $this->assertEquals($expected, $resource->toArray(new Request()));
  }

}
