<?php

namespace Domain\Shipping\Types;

enum Carriers: string {
  case POSTNL = 'PostNL';
  case DHL = 'DHL';
  case DPD = 'DPD';
  case UPS = 'UPS';
}
