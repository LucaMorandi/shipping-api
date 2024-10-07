<?php

namespace Domain\Shipping\Types;

enum ShippingPermissions: string {
  case VIEW_SERVICES = 'view:shipping-services';
}
