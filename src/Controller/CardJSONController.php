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

class CardJSONController extends AbstractController
{
    public function checkDeck(SessionInterface $session)
    {
        $existingDeck = $session->get("deck");
        if (is_null($existingDeck)) {
            $deck = new DeckOfCards();
            $session->set('deck', serialize($deck->getDeckArray()));
        }
    }

    #[Route("/api/card/deck", name: "api/card/deck", methods: ['GET'])]
    public function deck(SessionInterface $session): Response
    {
        $this->checkDeck($session);
        $deck = new DeckOfCards(unserialize($session->get("deck")));
        $data = [
            'deck' =>  $deck->getDeckArray()
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }


    #[Route("/api/card/deck/shuffle", name: "api/card/deck/shuffle", methods: ['POST'])]
    public function shuffle(SessionInterface $session): Response
    {
        /*$deck =  unserialize($session->get("deck"));
        shuffle($deck);*/
        $deck = new DeckOfCards();
        $deckShuffled = $deck->getDeckArray();
        shuffle($deckShuffled);
        $data = [
            'deck' =>  $deckShuffled
        ];
        $session->set('deck', serialize($deckShuffled));

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }


    /*#[Route("/card/deck/draw", name: "card/deck/draw")]
    public function drawOne(): Response
    {

        return $this->redirect('card/deck/draw/1');
    }*/

    #[Route("/api/card/deck/draw/{num<\d+>}", name: "api/card/deck/draw", methods: ['POST'])]
    public function draw(SessionInterface $session, int $num = 1): Response
    {
        $this->checkDeck($session);
        $deck =  unserialize($session->get("deck"));
        if ($num <= count($deck)) {
            $hand = new CardHand();
            $hand->draw($num, $deck);
            $newDeck = new DeckOfCards($deck);
            $session->set('deck', serialize($newDeck->getDeckArray()));
            $data = [
                'hand' => $hand->getHand(),
                'cardsInDeck' => count($newDeck->getDeckArray())
            ];
        } else {
            $data = [
                'cardsMessage' => "You can't pick $num amount of cards, you don't have enough left."
            ];
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
