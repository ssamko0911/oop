<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\PasswordGeneratorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/password/generate', name: 'password_generate', methods: ['GET'])]
    public function generatePassword(): Response
    {
        $form = $this->createForm(PasswordGeneratorFormType::class);

        return $this->render('password/generate_password.html.twig', [
            'header' => 'Generate Password',
            'form' => $form->createView(),
        ]);
    }
}
