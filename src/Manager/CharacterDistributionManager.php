<?php declare(strict_types=1);

namespace App\Manager;

use App\Entity\Enum\EnabledCharacterType;

class CharacterDistributionManager
{
    /** @var array<int, string> $enabledCharacterTypes  */
    private array $enabledCharacterTypes;

    public function __construct()
    {
        $this->enabledCharacterTypes = [
            EnabledCharacterType::LOWERCASE->value,
            EnabledCharacterType::UPPERCASE->value,
        ];
    }

    /**
     * @param int $length
     * @return array<string,int>
     */
    public function getCharacterDistribution(int $length): array
    {
        $base = intdiv($length, count($this->enabledCharacterTypes));
        $reminder = $length % count($this->enabledCharacterTypes);

        $distribution = [];

        foreach ($this->enabledCharacterTypes as $type) {
            $distribution[$type] = $base;
        }

        $keys = array_keys($distribution);
        for ($i = 0; $i < $reminder; $i++) {
            $randomKey = $keys[array_rand($keys)];
            $distribution[$randomKey]++;
        }

        return $distribution;
    }

    public function setEnabledCharacterTypes(string $enabledCharacterType): self
    {
        if (!in_array($enabledCharacterType, $this->enabledCharacterTypes, true)) {
            $this->enabledCharacterTypes[] = $enabledCharacterType;
        }
        return $this;
    }
}
