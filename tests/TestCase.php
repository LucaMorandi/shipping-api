<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route as RouteFacade;

abstract class TestCase extends BaseTestCase {

  use RefreshDatabase;

  protected function setUp(): void {
    parent::setUp();

    $this->withHeaders([
      'Accept' => 'application/json',
      'Content-Type' => 'application/json',
    ]);
  }

  public function get_route(string $method, string $uri): Route {
    $request = Request::create($uri, $method);
    return RouteFacade::getRoutes()->match($request);
  }

  protected function hasMiddleware(Route $route, string $middleware_name): bool {
    return in_array($middleware_name, $route->gatherMiddleware());
  }

}
