<?php

namespace System\Http;

interface IResponse
{
  public function statusCode(int $code): void;
  public function redirect(string $url): void;
  public function json(mixed $data, int $code = 200): string;
}
