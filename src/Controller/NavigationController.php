<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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


    /* #[Route("/card", name: "card")]
     public function initCallback(
         Request $request,
         SessionInterface $session
     ): Response
     {
         $existingDeck = $session->get("deck");
         if (is_null($existingDeck)) {
             $deck = new DeckOfCards;
             $session->set('deck',serialize($deck->getDeckArray()));
         }
         return $this->render('card.html.twig');
     }



     #[Route("/session", name: "session")]
     public function session(Request $request, SessionInterface $session): Response
     {
         $data = [
             "sessionData" =>  $request->getSession()->all()
         ];

         return $this->render('session.html.twig', $data);
     }

     #[Route("/session/delete", name: "session/delete")]
     public function sessionDelete(Request $request, SessionInterface $session): Response
     {
         $session->clear();
         $this->addFlash(
             'notice',
             'You deleted your session'
         );
         $data = [
             "sessionData" =>  $request->getSession()->all()
         ];

         return $this->render('session.html.twig', $data);
     }


     #[Route("/card/deck", name: "card/deck")]
     public function deck(SessionInterface $session): Response
     {
         $deck = new DeckOfCards(unserialize($session->get("deck")));
         $data = [
             'deck' =>  $deck->getString()
         ];
         return $this->render('deck.html.twig', $data);
     }


     #[Route("/card/deck/shuffle", name: "card/deck/shuffle")]
     public function shuffle(SessionInterface $session): Response
     {
         /*$deck =  unserialize($session->get("deck"));
         shuffle($deck);*/
    /*$deck = new DeckOfCards;
    $deckShuffled = $deck->getDeckArray();
    shuffle($deckShuffled);
    $newDeck = new DeckOfCards($deckShuffled);
    $data = [
        'deck' =>  $newDeck->getString()
    ];
    $session->set('deck',serialize($deckShuffled));

    return $this->render('deck.html.twig', $data);
    }


    /*#[Route("/card/deck/draw", name: "card/deck/draw")]
    public function drawOne(): Response
    {

    return $this->redirect('card/deck/draw/1');
    }*/

    /*#[Route("/card/deck/draw/{num<\d+>}", name: "card/deck/draw")]
    public function draw(SessionInterface $session, int $num=1): Response
    {

        $deck =  unserialize($session->get("deck"));
        if ($num <= count($deck)) {
            $hand = new CardHand;
            $hand->draw($num,$deck);
            $newDeck = new DeckOfCards($deck);
            $session->set('deck',serialize($newDeck->getDeckArray()));
            $data = [
                'hand' => $hand->getString(),
                'cardsInDeck' => count($newDeck->getDeckArray())
            ];
        }
        else {
            $data = [
                'cardsMessage' => "You can't pick $num amount of cards, you don't have enough left."
            ];
        }

        return $this->render('draw.html.twig', $data);
    }
*/
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
            'current-date' => $currentDate,
            'timestamp' => date('Y-m-d H:i:s', $timestamp)
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
