<?php

namespace System\Container;

class ContainerClass
{
  use ContainerHelper;

  public function resolveClass(object|string $className): mixed
  {
    $ref = new \ReflectionClass($className);
    $constr = $ref->getConstructor();
    $deps = [];

    if ($constr !== null) {
      $deps = $this->getDeps($constr);
    }

    return new $className(...$deps);
  }

  public function resolveMethod(object $instanceClass, string $methodName, array $defaultDeps = []): mixed
  {
    $ref = new \ReflectionClass($instanceClass);
    $refMethod = $ref->getMethod($methodName);
    $deps = $this->getDeps($refMethod, $defaultDeps);

    return $instanceClass->$methodName(...$deps);
  }
}