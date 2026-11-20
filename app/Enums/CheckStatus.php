<?php

declare(strict_types=1);

namespace App\Enums;

enum CheckStatus: string
{
    case COMPLETED = 'COMPLETED';
    case FAILED = 'FAILED';
}
