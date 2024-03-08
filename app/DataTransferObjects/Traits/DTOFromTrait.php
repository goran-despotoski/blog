<?php

namespace App\DataTransferObjects\Traits;

trait DTOFromTrait
{
    public static function fromArray(array $values): self
    {
        $dto = new self();
        foreach ($values as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }

        return $dto;
    }
}
