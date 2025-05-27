<?php

namespace App\Controller;

use App\Message\CalculateUserSumMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    #[Route('/calc/{endNumber}', name: 'calc', methods: ['GET'])]
    public function calculate(int $endNumber, MessageBusInterface $messageBus): JsonResponse
    {
        $message = new CalculateUserSumMessage($endNumber);
        $messageBus->dispatch($message);

        return new JsonResponse("We are working on it!", Response::HTTP_OK);
    }
}