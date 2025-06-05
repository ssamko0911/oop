<?php declare (strict_types = 1);

namespace App\Service;

use App\Config\CharacterConfig;
use InvalidArgumentException;

final readonly class SingleRandomCharacterGenerator
{

    public function __construct(
        private CharacterConfig $charPool
    )
    {
    }

    public function getCharacterFromPool(string $charType): string
    {
        $charTypeConfig = $this->charPool->getCharacterConfig($charType);

        if (empty($charTypeConfig)) {
            throw new InvalidArgumentException('CharacterPool cannot be empty');
        }

        $charCode = $charTypeConfig[array_rand($charTypeConfig)];

        return chr($charCode);
    }
}
