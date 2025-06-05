<?php declare(strict_types=1);

namespace App\Entity\Enum;

enum EnabledCharacterType: string
{
    case LOWERCASE = 'lowercase_letters';
    case UPPERCASE = 'uppercase_letters';
    case NUMBERS = 'numbers';
    case SPECIAL_SYMBOLS = 'special_symbols';
}
