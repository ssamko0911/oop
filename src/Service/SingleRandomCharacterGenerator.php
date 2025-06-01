<?php declare (strict_types = 1);

namespace App\Service;

final readonly class SingleRandomCharacterGenerator
{
    /**
     * @param int[] $charPool
     * @return string
     */
    public function generate(array $charPool): string
    {
        $charCode = $this->generateSingleCharacterNumber($charPool);

        return $this->getSingleCharacter($charCode);
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
