<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Traits\DTOFromTrait;
use App\DataTransferObjects\Traits\DTOToTrait;

class PostDTO
{
    use DTOFromTrait, DTOToTrait;

    public int $id;

    public int $user_id;

    public string $title;

    public string $slug;

    public string $content;

    public ?string $published_at;

    public ?string $published_at_date;

    public ?string $published_at_time;

    public string $status;
}
