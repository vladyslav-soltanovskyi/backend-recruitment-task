<?php

namespace System\Container;

trait ContainerHelper
{
  public function getDeps(\ReflectionMethod|\ReflectionFunction $refMethod, array $defaultDeps = []): array
  {
    $deps = [];
    $params = $refMethod->getParameters();

    foreach ($params as $param) {
      $name = $param->getType()->getName();
      $container = new ContainerClass();
      
      if (class_exists($name)) {
        $instance = $container->resolveClass($name);
        $deps[] = $instance;
      }
    }
    return [...$deps, ...$defaultDeps];
  }
}
