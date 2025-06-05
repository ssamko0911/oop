<?php declare(strict_types=1);

namespace App\DTO;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

final class PasswordParamDTO
{
    #[Assert\Type(Types::BOOLEAN)]
    public bool $numbers = false;

    #[Assert\Type(Types::BOOLEAN)]
    public bool $special_symbols = false;

    #[Assert\Type(Types::INTEGER)]
    #[Assert\Range(
        notInRangeMessage: 'Password must be between {{ min }} - {{ max }} characters long',
        min: 8,
        max: 100,
    )]
    public int $length;
}
