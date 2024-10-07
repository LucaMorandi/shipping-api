<?php

namespace Domain\Shipping\Types;

enum Regions: string {
  case NL = 'NL';
  case BE = 'BE';
  case EU = 'EU';
  case ROW = 'ROW';
}
