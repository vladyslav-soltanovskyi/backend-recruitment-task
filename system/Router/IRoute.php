<?php

namespace System\Router;

interface IRoute
{
  public static function get(string $url, array|callable $callback): void;
  public static function post(string $url, array|callable $callback): void;
  public static function put(string $url, array|callable $callback): void;
  public static function delete(string $url, array|callable $callback): void;
  public static function getRouteMap(): array;
}
