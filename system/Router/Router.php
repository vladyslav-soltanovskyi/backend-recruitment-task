<?php

namespace System\Router;

use System\Exceptions\NotFoundRouteException;
use System\Container\ContainerClass;
use System\Container\ContainerFunction;
use System\Http\Request;

class Router implements IRouter
{
  private Request $request;
  private array $params = [];

  public function __construct()
  {
    $this->request = new Request;
  }

  public function resolve(array $routeMap): mixed
  {
    $method = $this->request->getMethod();
    $url = $this->request->getUrl();
    $routes = $routeMap[$method];
    $callback = $routes[$url] ?? false;

    if (!$callback) {
      $callback = $this->getCallback($url, $routes);

      if ($callback === false) {
        throw new NotFoundRouteException();
      }
    }

    if (is_array($callback)) {
      $container = new ContainerClass();
      $controller = $container->resolveClass($callback[0]);

      return $container->resolveMethod($controller, $callback[1], $this->params);
    }

    $container = new ContainerFunction();
    return $container->resolve($callback, $this->params);
  }

  private function getCallback(string $url, array $routes): array|callable|false
  {
    $url = trim($url, '/');

    foreach ($routes as $route => $callback) {
      $route = trim($route, '/');

      if (!$route) {
        continue;
      }

      $routeRegex = $this->getRouteRegex($route);

      if ($this->checkIsSameRoutes($url, $routeRegex)) {
        $this->params = $this->getParamsInRoute($url, $routeRegex);

        return $callback;
      }
    }

    return false;
  }

  private function checkIsSameRoutes(string $searchRoute, string $route): bool
  {
    return !!preg_match($route, $searchRoute);
  }

  private function getRouteRegex(string $route): string
  {
    return "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn ($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";
  }

  private function getParamsInRoute(string $url, string $routeRegex): array
  {
    $values = [];

    if (preg_match_all($routeRegex, $url, $valueMatches)) {
      for ($i = 1; $i < count($valueMatches); $i++) {
        $values[] = $valueMatches[$i][0];
      }
    }

    return $values;
  }
}
