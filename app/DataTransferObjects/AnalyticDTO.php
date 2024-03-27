<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Traits\DTOFromTrait;
use App\DataTransferObjects\Traits\DTOToTrait;

class AnalyticDTO
{
    use DTOFromTrait, DTOToTrait;

    public int $id;

    public int $team_id;

    public string $title;

    public string $script_content;
}
