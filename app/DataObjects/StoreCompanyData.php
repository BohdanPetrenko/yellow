<?php

namespace App\DataObjects;

final class StoreCompanyData
{
    private function __construct(
        private string $title,
        private string $phone,
        private string $description,
    )
    {
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            $data['title'],
            $data['phone'],
            $data['description'],
        );
    }

    /**
     * @return array
     */
    public function toStore(): array
    {
        return [
            'title'       => $this->title,
            'phone'       => $this->phone,
            'description' => $this->description,
        ];
    }
}