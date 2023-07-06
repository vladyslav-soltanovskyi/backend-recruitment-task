<?php

namespace App\Controllers;

use App\Requests\CreateUserRequest;
use App\Services\UserService;
use System\Exceptions\HttpException;
use System\Http\Response;

class UserController
{
  private UserService $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;  
  }

  public function getAll(Response $response)
  {
    return $response->json($this->userService->getAll());
  }

  public function create(CreateUserRequest $request, Response $response)
  {
    $data = $request->getBody();
    $newUser = $this->userService->create($data);
    
    return $response->json($newUser, 201);
  }

  public function delete(Response $response, int $id)
  {
    if (!$this->userService->delete($id)) {
      throw new HttpException(404, 'User Not Found');
    }
    
    return $response->json('', 204);
  }
}
