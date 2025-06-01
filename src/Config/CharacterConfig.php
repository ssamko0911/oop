<?php declare(strict_types=1);

namespace App\Config;
use App\Entity\Enum\EnabledCharacterType;

class CharacterConfig
{
    /**
     * @return array<string, int[]>
     */
    public static function getCharacterConfig(): array
    {
        return [
            EnabledCharacterType::NUMBERS->value => range(48, 57),
            EnabledCharacterType::LOWERCASE->value => range(97, 122),
            EnabledCharacterType::UPPERCASE->value => range(65, 90),
            EnabledCharacterType::SPECIAL_SYMBOLS->value => array_merge(
                range(32, 38),
                range(40, 43),
                [45, 46],
                range(58, 64),
                [91],
                range(93, 96),
                range(123, 126),
            )
        ];
    }
}
