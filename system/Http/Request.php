<?php

namespace System\Http;

class Request implements IRequest
{
  public function getMethod(): string
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  public function getUrl(): string
  {
    $path = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'];
    return $path;
  }

  public function getBody(): array
  {
    $data = [];
    $inputData = file_get_contents('php://input');

    if (!!$inputData) {
      $data = json_decode($inputData, true);
    } else {
      $data = $_POST;
    }
    $data = $this->getValidData($data);

    return $data;
  }

  private function getValidData(array $data): array
  {
    $res = array_map(function ($value) {
      if (gettype($value) === 'string') {
        $value = htmlspecialchars(trim($value));
      }

      return $value;
    }, $data);

    return $res;
  }

  public function getQuery(): array
  {
    return $this->getValidData($_GET);
  }
}
