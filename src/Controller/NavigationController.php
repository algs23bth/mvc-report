<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class NavigationController extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $numberWordDict = array(
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six'
        );
        $number = random_int(1, 6);

        $data = [
            'number' => $numberWordDict[$number]
        ];

        return $this->render('lucky_image.html.twig', $data);
    }

    #[Route("/", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }


    
    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/api", name: "api")]
    public function jsonRoutes(): Response
    {
        return $this->render('json_routes.html.twig');
    }

    #[Route("/api/lucky", name:"api/lucky")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        
        $data = [
            'lucky-number' => $number,
            'lucky-message' => 'Hi there!',
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }


    #[Route("/api/quote", name:"api/quote")]
    public function jsonQuote(): Response
    {
        $number = random_int(1, 4);

        $currentDate = date('Y-m-d');

        $quoteList = array(
            1 => 'I refuse to join any club that would have me as a member. - Groucho Marx',
            2 => 'Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead',
            3 => 'I can resist everything except temptation. - Oscar Wilde',
            4 => 'I would never die for my beliefs because I might be wrong. - Bertrand Russell'
        );

        $timestamp = time();
        $data = [
            'quote' => $quoteList[$number],
            'generated-date' => $currentDate,
            'timestamp' => $timestamp
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
