<?php

namespace App\Console\Commands;

use Domain\Shipping\Interfaces\ShippingServiceViewRepositoryInterface;
use Illuminate\Console\Command;

class RefreshShippingServicesView extends Command {

  /**
   * @var string
   */
  protected $signature = 'refresh-view:shipping-services';

  /**
   * @var string
   */
  protected $description = 'Refresh potentially stale data in the shipping services view';

  public function __construct(
    private readonly ShippingServiceViewRepositoryInterface $shippingServiceViewRepository,
  ) {
    parent::__construct();
  }

  public function handle(): void {
    $this->shippingServiceViewRepository->refreshView();
  }

}

