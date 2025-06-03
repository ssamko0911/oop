<?php declare (strict_types = 1);

namespace App\Entity;

use InvalidArgumentException;

final readonly class SingleRandomCharacter
{
    public static function getCharacterFromPool(array $charPool): string
    {
        if (empty($charPool)) {
            throw new InvalidArgumentException('CharacterPool cannot be empty');
        }

        $charCode = $charPool[array_rand($charPool)];
        return chr($charCode);
    }
}
