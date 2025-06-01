<?php declare(strict_types=1);

namespace App\Controller;

use App\Builder\PasswordParamDTOBuilder;
use App\DTO\PasswordParamDTO;
use App\Service\PasswordGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PasswordController extends AbstractController
{
    public function __construct(
        private readonly PasswordParamDTOBuilder $builder,
        private readonly PasswordGeneratorService $passwordGeneratorService,
    ) {
    }

    #[Route(path: '/password', name: 'password', methods: ['POST'])]
    public function createPassword(
        #[MapRequestPayload] PasswordParamDTO $passwordParamDTO,
        //ValidatorInterface $validator
    ): Response {
        try {
            $password = $this->passwordGeneratorService->generate($passwordParamDTO);

            return $this->render('password/show_password.html.twig', [
                'password' => $password,
            ]);
        } catch (ValidationFailedException $e) {
            foreach ($e->getViolations() as $violation) {
                $this->addFlash('error', $violation->getMessage());
            }

            return $this->render('password/generate_password.html.twig');
        }

        //$params = $this->builder->build($request);
        //$errors = $validator->validate($passwordParamDTO);

//        if (count($errors) > 0) {
//            $errorMessages = [];
//
//            foreach ($errors as $error) {
//                $errorMessages[] = $error->getMessage();
//            }
//
//            return $this->render('password/generate_password.html.twig', [
//                'errors' => $errorMessages,
//            ]);
//        }

//        if (count($errors) > 0) {
//            foreach ($errors as $error) {
//                $this->addFlash('error', $error->getMessage());
//            }
//
//            return $this->render('password/generate_password.html.twig');
//        }
//
//        $password = $this->passwordGeneratorService->generate($passwordParamDTO);
//
//        return $this->render('password/show_password.html.twig', [
//            'password' => $password,
//        ]);
    }
}
