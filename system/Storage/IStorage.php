<?php

namespace System\Storage;

interface IStorage
{
  public function all(): array;
  public function create(?array $fields): array;
  public function get(int $id): ?array;
  public function has(int $id): bool;
  public function delete(int $id): bool;
  public function update(int $id, array $fields): bool;
}
