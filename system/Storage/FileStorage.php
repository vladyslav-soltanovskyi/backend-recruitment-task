<?php

namespace System\Storage;

class FileStorage implements IStorage
{
	protected int $lastId = 0;
	protected array $records = [];
	protected string $dbPath;

	public function __construct(string $dbPath)
	{
		$this->dbPath = $dbPath;
		$this->all();
	}

	public function all(): array
	{
		if (file_exists($this->dbPath)) {
			$data = json_decode(file_get_contents($this->dbPath), true);
			$this->records = $data;
			$this->lastId = end($data)['id'];
		}
		return $this->records;
	}

	public function create(?array $fields = []): array
	{
		$id = ++$this->lastId;
		$newEntity = ['id' => $id, ...$fields];
		$this->records[] = $newEntity;
		$this->save();
		return $newEntity;
	}

	public function get(int $id): ?array
	{
		if ($this->has($id)) {
			$index = $this->getIndexById($id);
			return $this->records[$index];
		}

		return null;
	}

	public function delete(int $id): bool
	{
		if ($this->has($id)) {
			$index = $this->getIndexById($id);
			unset($this->records[$index]);
			$this->save();
			return true;
		}

		return false;
	}

	public function has(int $id): bool
	{
		foreach($this->records as $record) {
			if ($record['id'] === $id) {
				return true;
			}
		}
		return false;
	}

	private function getIndexById(int $id): int
	{
		foreach($this->records as $i => $record) {
			if ($record['id'] === $id) {
				return $i;
			}
		}
		return -1;
	}

	public function update(int $id, array $fields): bool
	{
		if ($this->has($id)) {
			$index = $this->getIndexById($id);
			$record = $this->records[$index];
			$this->records[$index] = [...$record, ...$fields];
			$this->save();
			return true;
		}

		return false;
	}

	protected function save()
	{
		file_put_contents($this->dbPath, json_encode($this->records, JSON_PRETTY_PRINT));
	}
}