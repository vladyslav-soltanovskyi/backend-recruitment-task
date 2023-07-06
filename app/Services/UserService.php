<?php

namespace App\Services;

use System\Config\Config;
use System\Storage\FileStorage;

class UserService
{
  private FileStorage $fileStorage;
  
  public function __construct()
  {
    $path = Config::get('app.rootPath') . '/dataset/users.json';
    $this->fileStorage = new FileStorage($path);
  }

  public function get(int $id): ?array
  {
    return $this->fileStorage->get($id);
  }

  public function getAll(): array
  {
    return $this->fileStorage->all();
  }

  public function create(array $data): array
  {
    $name = "{$data['firstName']} {$data['lastName']}";
    $phone = trim($data['phone'] . ' ' . ($data['extension'] ?? ''));

    $geo = [
      'lat' => !!$data['lat'] ? floatval($data['lat']) : 0,
      'lng' => !!$data['lng'] ? floatval($data['lng']) : 0,
    ];

    $address = [
      'street' => $data['street'],
      'suite' => !!$data['suite'] ? $data['suite'] : 'Default Suite',
      'city' => $data['city'],
      'zipcode' => $data['zipcode'],
      'geo' => $geo
    ];

    $company = [
      'name' => $data['companyName'],
      'catchPhrase' => !!$data['catchPhrase'] ? $data['catchPhrase'] : "Default CatchPhrase",
      'bs' => !!$data['bs'] ? $data['bs'] : 'Default BS'
    ];

    return $this->fileStorage->create([
      'name' => $name,
      'username' => $data['username'],
      'email' => $data['email'],
      'phone' => $phone,
      'website' => !!$data['website'] ? $data['website'] : 'default.website.com',
      'address' => $address,
      'company' => $company
    ]);
  }
  
  public function delete(int $id): bool
  {
    return $this->fileStorage->delete($id);
  }
}