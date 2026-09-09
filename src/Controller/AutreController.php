<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AutreController extends AbstractController
{
    #[Route('/autre-chose')]
    public function number(): Response
    {
        $number = random_int(0, 100);

	return $this->render('autre-chose.html.twig');
    }
}
