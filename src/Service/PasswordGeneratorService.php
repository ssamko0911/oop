<?php declare(strict_types=1);

namespace App\Service;

use App\Config\CharacterConfig;
use App\DTO\PasswordParamDTO;
use App\Entity\Enum\EnabledCharacterType;
use App\Manager\CharacterDistributionManager;

final readonly class PasswordGeneratorService
{
    public function __construct(
        private MultipleRandomCharacterGenerator $generator,
        private CharacterDistributionManager $manager,
    ) {
    }

    public function generate(PasswordParamDTO $passwordParams): string
    {
        $tempPass = '';
        $config = CharacterConfig::getCharacterConfig();

        if ($passwordParams->numbers) {
            $this->manager->setEnabledCharacterTypes(EnabledCharacterType::NUMBERS->value);
        }

        if ($passwordParams->special_symbols) {
            $this->manager->setEnabledCharacterTypes(EnabledCharacterType::SPECIAL_SYMBOLS->value);
        }

        $distribution = $this->manager->getCharacterDistribution($passwordParams->length);

        foreach ($distribution as $charType => $length) {
            $tempPass .= $this->generator->generate($length, $config[$charType]);
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
