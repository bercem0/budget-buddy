<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController
{
    #[Route('/test')]
    public function test(): Response
    {
        return new Response('Budget Buddy werkt 🚀');
    }
}

?>