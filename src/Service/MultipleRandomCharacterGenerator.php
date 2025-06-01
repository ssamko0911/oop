<?php declare(strict_types=1);

namespace App\Service;

final readonly class MultipleRandomCharacterGenerator
{
    public function __construct(
        private SingleRandomCharacterGenerator $singleRandomCharacterGenerator,
    ) {
    }

    /**
     * @param int $length
     * @param int[] $charPool
     * @return string
     */
    public function generate(int $length, array $charPool): string
    {
        $multipleRandomChars = '';
        for ($i = 0; $i < $length; $i++) {
            $singleRandomChar = $this->singleRandomCharacterGenerator->generate($charPool);
            $multipleRandomChars .= $singleRandomChar;
        }

        return $multipleRandomChars;
    }
}
