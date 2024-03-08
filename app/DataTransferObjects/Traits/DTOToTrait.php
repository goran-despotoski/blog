<?php

namespace App\DataTransferObjects\Traits;

trait DTOToTrait
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
