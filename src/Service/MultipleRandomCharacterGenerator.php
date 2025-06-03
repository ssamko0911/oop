<?php declare(strict_types=1);

namespace App\Service;

final readonly class MultipleRandomCharacterGenerator
{
    public function __construct(
        private SingleRandomCharacterGenerator $singleRandomCharacter,
    )
    {
    }

    /**
     * @param int $length
     * @param string $charType
     * @return string
     */
    public function getMultipleCharacters(int $length, string $charType): string
    {
        $multipleRandomChars = '';

        for ($i = 0; $i < $length; $i++) {
            $multipleRandomChars .= $this->singleRandomCharacter->getCharacterFromPool($charType);
        }

        return $multipleRandomChars;
    }
}
