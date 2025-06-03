<?php declare(strict_types=1);

namespace App\Entity;

final readonly class MultipleRandomCharacter
{
    /**
     * @param int $length
     * @param int[] $charPool
     * @return string
     */
    public static function getMultipleCharacters(int $length, array $charPool): string
    {
        $multipleRandomChars = '';

        for ($i = 0; $i < $length; $i++) {
            $multipleRandomChars .= SingleRandomCharacter::getCharacterFromPool($charPool);
        }

        return $multipleRandomChars;
    }
}
