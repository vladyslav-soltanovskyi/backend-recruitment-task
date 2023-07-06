<?php

namespace App\Requests;

use System\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'firstName' => 'required',
			'lastName' => 'required',
			'username' => 'required',
			'email' => 'required|email',
			'phone' => 'required|regex:/^(?:\+?1[-. ]?)?\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$/',
			'extension' => 'nullable|regex:/^(x\d{0,6})?$/',
			'website' => 'nullable|regex:/^((https?):\/\/)?(www\.)?([A-Za-z0-9]{1}[A-Za-z0-9\-]*\.?)*\.{1}[A-Za-z0-9-]{2,8}(\/([\w#!:.?+=&%@!\-\/])*)?/',

			'street' => 'required',
			'city' => 'required',
			'zipcode' => 'required|regex:/^[0-9]{5}(?:-[0-9]{4})?$/',

			'companyName' => 'required|max:100',
			'catchPhrase' => 'nullable|max:250',
			'bs' => 'nullable|max:250',
			'lat' => 'nullable|numeric',
			'lng' => 'nullable|numeric'
		];
	}
}
