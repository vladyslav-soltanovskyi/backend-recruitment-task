<?php

namespace System\Http;

use System\Exceptions\HttpException;
use Rakit\Validation\Validator;
use System\Http\Rules\NullableOrNumericRule;

class FormRequest extends Request
{
  private Validator $validator;

  public function __construct()
  {
    $this->validator = new Validator;
    $this->checkBody();
  }

  public function rules(): array
  {
    return [];
  }

  private function checkBody(): void
  {
    $rules = $this->rules();
    $validation = $this->validator->validate($this->getBody(), $rules);

    if ($validation->fails()) {
      throw new HttpException(422, $validation->errors()->toArray());
    }
  }
}
