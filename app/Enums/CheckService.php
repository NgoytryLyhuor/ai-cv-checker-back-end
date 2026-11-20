<?php

declare(strict_types=1);

namespace App\Enums;

enum CheckService: string
{
    case REVIEW = 'review';
    case KM_TO_EN = 'km_to_en';
    case EN_TO_KM = 'en_to_km';
    case FULL = 'full';
}
