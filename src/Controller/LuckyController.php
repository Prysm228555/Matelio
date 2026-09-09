<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LuckyController extends AbstractController
{
    #[Route('/lucky-number')]
    #[IsGranted('ROLE_USER')]
    public function number(): Response
    {
        $number = random_int(0, 100);

	return $this->render('lucky-number.html.twig', [
            'number' => $number,
        ]);
    }
}
