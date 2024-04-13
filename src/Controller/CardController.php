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

class CardController extends AbstractController
{
    public function checkDeck(SessionInterface $session)
    {
        $existingDeck = $session->get("deck");
        if (is_null($existingDeck)) {
            $deck = new DeckOfCards();
            $session->set('deck', serialize($deck->getDeckArray()));
        }
    }
    #[Route("/card", name: "card")]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response {
        /*$existingDeck = $session->get("deck");
        if (is_null($existingDeck)) {
            $deck = new DeckOfCards;
            $session->set('deck',serialize($deck->getDeckArray()));
        }*/
        $this->checkDeck($session);
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
        $this->checkDeck($session);
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
        $deck = new DeckOfCards();
        $deckShuffled = $deck->getDeckArray();
        shuffle($deckShuffled);
        $newDeck = new DeckOfCards($deckShuffled);
        $data = [
            'deck' =>  $newDeck->getString()
        ];
        $session->set('deck', serialize($deckShuffled));

        return $this->render('deck.html.twig', $data);
    }


    /*#[Route("/card/deck/draw", name: "card/deck/draw")]
    public function drawOne(): Response
    {

        return $this->redirect('card/deck/draw/1');
    }*/

    #[Route("/card/deck/draw/{num<\d+>}", name: "card/deck/draw")]
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
                'hand' => $hand->getString(),
                'cardsInDeck' => count($newDeck->getDeckArray())
            ];
        } else {
            $data = [
                'cardsMessage' => "You can't pick $num amount of cards, you don't have enough left."
            ];
        }

        return $this->render('draw.html.twig', $data);
    }
}
