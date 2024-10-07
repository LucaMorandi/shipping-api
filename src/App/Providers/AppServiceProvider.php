<?php

namespace App\Providers;

use Domain\Shipping\Interfaces\ShippingServiceViewRepositoryInterface;
use Domain\Shipping\Repositories\ShippingServiceViewRepository;
use Domain\Users\Interfaces\UserRepositoryInterface;
use Domain\Users\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

  /**
   * Register any application services.
   */
  public function register(): void {
    $this->app->bind(
      ShippingServiceViewRepositoryInterface::class,
      ShippingServiceViewRepository::class,
    );

    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {}

}
