<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    /*#[Route("/api/lucky")]
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


    #[Route("/api/quote")]
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
    }*/
}