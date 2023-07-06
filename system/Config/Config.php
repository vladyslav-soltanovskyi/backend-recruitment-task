<?php

namespace System\Config;

use Codin\Dot\Dot;

class Config implements IConfig
{
  public const IGNORE_FILES = ['.', '..'];
  private static array $config = [];

  public static function get(string $key): mixed
  {
    $dot = new Dot(self::$config);
    return $dot->get($key);
  }

  public static function init(): void
  {
    $path = __DIR__ . '/../../config';
    $files = scandir($path);
    $files = array_filter($files, fn ($file) => !in_array($file, self::IGNORE_FILES));
    
    foreach ($files as $file) {
      $data = include "$path/$file";
      if (is_array($data)) {
        self::$config[basename($file, '.php')] = $data;
      }
    }
  }
}
