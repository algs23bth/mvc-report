<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    private $graphicDeck = [];

    private $deck = [];

    protected $suits = array("hearts", "clubs", "diamonds", "spades");
    protected $ranks = array("1","2","3","4","5","6","7","8","9","10","A","J","Q","K");


    public function __construct(?array $deck = null)
    {
        if (is_null($deck)) {
            foreach ($this->suits as $suit) {
                foreach ($this->ranks as $rank) {


                    array_push($this->deck, array($suit, $rank));

                }
            }
        } else {
            $this->deck = $deck;
        }
        $this->createGraphicDeck();

    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function createGraphicDeck(): void
    {

        foreach ($this->deck as $card) {
            $cardGraphic = new CardGraphic($card[0], $card[1]);
            $this->graphicDeck[] = $cardGraphic;
        }
    }


    public function getString(): array
    {
        $values = [];
        foreach ($this->graphicDeck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }


    public function getDeckArray(): array
    {
        return $this->deck;
    }

}
