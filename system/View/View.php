<?php

namespace System\View;

use System\Config\Config;

class View
{
  private Template $template;

  public function __construct()
  {
    $this->template = new Template;
  }

  public function show(string $path, array $vars = []): string
  {
    return $this->render($path, [
      ...$vars,
      'component' => fn(string $path, array $vars = []) => $this->component($path, $vars)
    ]);
  }

  public function component(string $path, array $vars = []): string
  {
    return $this->render('components/' . $path, $vars);
  }

  public function exception(string $path, array $vars = []): string
  {
    return $this->render('errors/' . $path, $vars);
  }
  
  private function render(string $path, array $vars = []): string
  {
    $rootPath = Config::get('app.rootPath');
    $path =  $rootPath . '/assets/views/' . $path . '.php';

    return $this->template->render($path, $vars);
  }
}
