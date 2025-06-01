<?php declare(strict_types=1);

namespace App\Service;

use App\Config\CharacterConfig;
use App\DTO\PasswordParamDTO;
use App\Entity\Enum\EnabledCharacterType;
use App\Entity\MultipleRandomCharacter;
use App\Manager\CharacterDistributionManager;

final readonly class PasswordGeneratorService
{
    public function __construct(
        private CharacterDistributionManager $manager,
    ) {
    }

    public function generate(PasswordParamDTO $passwordParams): string
    {
        $tempPass = '';
        $config = CharacterConfig::getCharacterConfig();
        $multipleRandomCharacters = new MultipleRandomCharacter();


        if ($passwordParams->numbers) {
            $this->manager->setEnabledCharacterTypes(EnabledCharacterType::NUMBERS->value);
        }

        if ($passwordParams->special_symbols) {
            $this->manager->setEnabledCharacterTypes(EnabledCharacterType::SPECIAL_SYMBOLS->value);
        }

        $distribution = $this->manager->getCharacterDistribution($passwordParams->length);

        foreach ($distribution as $charType => $length) {
            $multipleRandomCharacters->setCharacters($length, $config[$charType]);
            $tempPass .= $multipleRandomCharacters->getCharacters();
        }

        return $this->shuffle($tempPass);
    }

    private function shuffle(string $tempPass): string
    {
        $characters = str_split($tempPass);

        for ($i = count($characters) - 1; $i > 0; $i--) {
            $random = random_int(0, $i);
            [$characters[$i], $characters[$random]] = [$characters[$random], $characters[$i]];
        }

        return implode('', $characters);
    }
}
