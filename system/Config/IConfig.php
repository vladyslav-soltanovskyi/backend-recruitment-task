<?php

namespace System\Config;

interface IConfig
{
  public static function get(string $key): mixed;
  public static function init(): void;
}
