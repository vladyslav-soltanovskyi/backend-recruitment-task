<?php

namespace System\Http;

interface IRequest
{
  public function getMethod(): string;
  public function getUrl(): string;
  public function getBody(): array;
  public function getQuery(): array;
}
