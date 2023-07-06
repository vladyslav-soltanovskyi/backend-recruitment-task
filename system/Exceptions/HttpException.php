<?php

namespace System\Exceptions;

class HttpException extends \Exception
{
  protected int $statusCode;
  protected array $errors = [];

  public function __construct($statusCode = 500, string|array $message = null, $code = 0, \Throwable $previous = null)
  {
    $this->statusCode = $statusCode;
    
    if (gettype($message) === 'array') {
      $this->errors = $message;
      $message = $this->getDefaultMessage($statusCode);
    }

    parent::__construct($message, $code, $previous);
  }

  public function getStatusCode()
  {
    return $this->statusCode;
  }

  public function getResponse()
  {
    $response = ['message' => $this->message];
    
    if (!empty($this->errors)) {
      $response['errors'] = $this->errors;
    }

    return $response;
  }

  private function getDefaultMessage($statusCode)
  {
    $statusMessages = array(
      404 => 'Not Found',
      422 => 'Unprocessable Entity',
      500 => 'Internal Server Error',
    );

    return $statusMessages[$statusCode] ?? $statusMessages[500];
  }
}
