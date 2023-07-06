<?php

namespace System\Http;

class Response implements IResponse
{
  public function statusCode(int $code): void
  {
    http_response_code($code);
  }

  public function redirect(string $url): void
  {
    header("Location: $url");
    die();
  }

  public function header(string $header, string $value): void
  {
    header("$header: $value");
  }

  public function json(mixed $data, int $code = 200): string
  {
    $this->header('Content-Type', 'application/json; charset=utf-8');
    $this->statusCode($code);
    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }
}
