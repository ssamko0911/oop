<?php declare(strict_types=1);

namespace App\Builder;

use App\DTO\PasswordParamDTO;
use Symfony\Component\HttpFoundation\Request;

class PasswordParamDTOBuilder
{
    public function build(Request $request): PasswordParamDTO
    {
        $dto = new PasswordParamDTO();
        $dto->length = (int)$request->get('length');
        $dto->numbers = (bool)$request->get('numbers');
        $dto->special_symbols = (bool)$request->get('special_symbols');

        return $dto;
    }
}
