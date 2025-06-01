<?php declare(strict_types=1);

namespace App\Entity;

final class MultipleRandomCharacter
{
    private string $characters = '';

    public function getCharacters(): string
    {
        return $this->characters;
    }

    /**
     * @param int $length
     * @param int[] $charPool
     * @return void
     */
    public function setCharacters(int $length, array $charPool): void
    {
        $multipleRandomChars = '';
        $singleRandomChar = new SingleRandomCharacter($charPool);

        for ($i = 0; $i < $length; $i++) {
            $singleRandomChar->setCharacter();
            $multipleRandomChars .= $singleRandomChar->getCharacter();
        }

        $this->characters = $multipleRandomChars;
    }
}
