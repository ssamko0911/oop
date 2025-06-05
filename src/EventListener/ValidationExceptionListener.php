<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

#[AsEventListener(event: KernelEvents::EXCEPTION, method: 'onKernelException')]
class ValidationExceptionListener
{
    public function __construct(
        private RouterInterface $router,
        private RequestStack $requestStack,
    )
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $exception = $exception->getPrevious();

        if ($exception instanceof ValidationFailedException) {
            $request = $event->getRequest();
            $session = $request->getSession();

            foreach ($exception->getViolations() as $violation) {
                $session->getFlashBag()->add('error', $violation->getMessage());
            }

            $response = new RedirectResponse($this->router->generate('password_generate'));
            $event->setResponse($response);
        }
    }
}