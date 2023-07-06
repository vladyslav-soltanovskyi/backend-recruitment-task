<?php

namespace System\Container;

class ContainerFunction
{
  use ContainerHelper;

  public function resolve(callable $callback, array $defaultDeps = [])
  {
    $ref = new \ReflectionFunction($callback);
    $deps = $this->getDeps($ref, $defaultDeps);
    
    return call_user_func($callback, ...$deps);
  }
}