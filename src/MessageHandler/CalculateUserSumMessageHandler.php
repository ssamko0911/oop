<?php

namespace App\MessageHandler;

use App\Message\CalculateUserSumMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CalculateUserSumMessageHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function __invoke(CalculateUserSumMessage $message)
    {
        $number = $message->getNumber();
        $sum = 0;

        for ($i = 1; $i <= $number; $i++) {
            $sum += $i;
        }

        $this->userRepository->find(1)->setSum($sum);
        $this->entityManager->flush();
    }
}