<?php

namespace Domain\Shipping\Types;

enum ParcelTypes: string {
  case STANDARD = 'standard';
  case MAILBOX = 'mailbox';
  case PALLET = 'pallet';
}
