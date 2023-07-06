<?php

namespace System\Router;

interface IRouter
{
  public function resolve(array $routeMap): mixed;
}
