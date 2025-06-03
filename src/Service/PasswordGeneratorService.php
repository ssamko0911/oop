<?php declare(strict_types=1);

namespace App\Service;

use App\Config\CharacterConfig;
use App\DTO\PasswordParamDTO;
use App\Entity\Enum\EnabledCharacterType;
use App\Entity\MultipleRandomCharacter;
use App\Manager\CharacterDistributionManager;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Random\RandomException;
use RuntimeException;

final readonly class PasswordGeneratorService
{
    public function __construct(
        private CharacterDistributionManager $manager,
        private LoggerInterface $logger,
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

        try {
            foreach ($distribution as $charType => $length) {
                $tempPass .= MultipleRandomCharacter::getMultipleCharacters($length, $config[$charType]);
            }

            return $this->shuffle($tempPass);
        } catch (InvalidArgumentException | RuntimeException $e) {
            $this->logger->error($e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }

    private function shuffle(string $tempPass): string
    {
        $characters = str_split($tempPass);
        try {
            for ($i = count($characters) - 1; $i > 0; $i--) {
                $random = random_int(0, $i);
                [$characters[$i], $characters[$random]] = [$characters[$random], $characters[$i]];
            }
        } catch (RandomException $e) {
            $this->logger->error($e->getMessage());
            throw new RuntimeException($e->getMessage());
        }

        return implode('', $characters);
    }
}
