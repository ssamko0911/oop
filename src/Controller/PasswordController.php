<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\PasswordParamDTO;
use App\Form\Type\PasswordGeneratorFormType;
use App\Service\PasswordGeneratorService;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class PasswordController extends AbstractController
{
    public function __construct(
        private readonly PasswordGeneratorService $passwordGeneratorService,
    ) {
    }

    #[Route(path: '/password', name: 'password', methods: ['POST'])]
    public function createPassword(
        #[MapRequestPayload] PasswordParamDTO $passwordParamDTO,
    ): Response {
        try {
            $password = $this->passwordGeneratorService->generate($passwordParamDTO);

            return $this->render('password/show_password.html.twig', [
                'header' => 'Your password',
                'password' => $password,
            ]);
        } catch (ValidationFailedException $e) {
            foreach ($e->getViolations() as $violation) {
                $this->addFlash('error', $violation->getMessage());
            }

            return $this->render('password/generate_password.html.twig', [
                'form' => $this->createForm(PasswordGeneratorFormType::class)->createView(),
            ]);
        } catch (RuntimeException) {
            $this->addFlash('error', 'Something went wrong, try again later');

            return $this->render('password/generate_password.html.twig', [
                'form' => $this->createForm(PasswordGeneratorFormType::class)->createView(),
            ]);
        }
    }
}
