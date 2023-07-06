<?php

namespace System\Router;

class Route implements IRoute
{
  private static array $routeMap = [];

  public static function get(string $url, array|callable $callback): void
  {
    static::$routeMap['get'][$url] = $callback;
  }

  public static function post(string $url, array|callable $callback): void
  {
    static::$routeMap['post'][$url] = $callback;
  }

  public static function put(string $url, array|callable $callback): void
  {
    static::$routeMap['put'][$url] = $callback;
  }
  
  public static function delete(string $url, array|callable $callback): void
  {
    static::$routeMap['delete'][$url] = $callback;
  }

  public static function getRouteMap(): array
  {
    return static::$routeMap;
  }
}