<?php

namespace App\Controllers;

use App\Services\UserService;
use System\View\View;

class SiteController
{
  private UserService $userService;
  private View $view;

  public function __construct(UserService $userService, View $view)
  {
    $this->userService = $userService;
    $this->view = $view;
  }

  public function users()
  {
    $users = $this->userService->getAll();

    return $this->view->show('pages/users', [
      'users' => $users
    ]);
  }

  public function createUser()
  {
    return $this->view->show('pages/create-user');
  }
}
