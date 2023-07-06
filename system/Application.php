<?php

namespace System;

use System\Exceptions\NotFoundRouteException;
use System\Config\Config;
use System\Exceptions\HttpException;
use System\Http\Response;
use System\Router\Router;
use System\Router\Route;
use System\View\View;

class Application {
  private Response $response;
  private View $view;

  public function __construct(Response $response, View $view)
  {
    $this->response = $response;
    $this->view = $view;
  }

  public function run() {
    try {
      $this->handle();
    } catch (HttpException $e) {
      echo $this->response->json($e->getResponse(), $e->getStatusCode());
    } catch (NotFoundRouteException $e) {
      echo $this->view->exception('404');
    } catch (\Throwable $e) {
      echo $this->view->exception('50x', [
        'error' => $e,
        'isProduction' => Config::get('app.isProduction')
      ]);
    }
  }

  public function handle()
  {
    Config::init();
    require_once __DIR__ . '/../routes/routes.php';
    $router = new Router();
    $res = $router->resolve(Route::getRouteMap());

    if (is_array($res) || is_object($res)) {
      echo $this->response->json($res);
    } elseif (!is_null($res)) {
      echo $res;
    }
  }
}