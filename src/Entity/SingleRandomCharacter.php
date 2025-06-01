<?php declare (strict_types = 1);

namespace App\Entity;

final class SingleRandomCharacter
{
    private string $character;

    public function __construct(
        /**  @var int[] $charPool */
        private array $charPool
    )
    {
    }

    public function getCharacter(): string
    {
        return $this->character;
    }

    public function setCharacter(): void
    {
        $charCode = $this->generateSingleCharacterNumber($this->charPool);
        $this->character = $this->getSingleCharacter($charCode);
    }

    /**
     * @param int[] $charPool
     * @return int
     */
    private function generateSingleCharacterNumber(array $charPool): int
    {
        return $charPool[array_rand($charPool)]; // Warning !!! array_rand???
    }

    private function getSingleCharacter(int $charCode): string
    {
        return chr($charCode);
    }
}
