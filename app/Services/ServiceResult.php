<?php
namespace App\Services;

class ServiceResult
{
    protected $fields = [
        'code' => null,
        'data' => [],
    ];

    public function __construct(array $fields = [])
    {
        $this->fill($fields);
    }

    public function __get(string $name)
    {
        return $this->fields[$name];
    }

    public function __set(string $name, $value): void
    {
        $this->fields[$name] = $value;
    }

    public function toArray(): array
    {
        return $this->fields;
    }

    public function isSuccess(): bool
    {
        return $this->fields['code'] == 200;
    }

    private function fill(array $fields): self
    {
        foreach ($fields as $fieldKey => $fieldValue) {
            $this->fields[$fieldKey] = $fieldValue;
        }
        return $this;
    }
}
