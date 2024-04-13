<?php

namespace App\Card;

use App\Card\CardGraphic;

class CardHand
{
    private $hand = [];



    public function draw(int $num, array &$deck): void
    {

        for ($i = 1; $i <= $num; $i++) {
            $card = array_pop($deck);
            $this->hand[] = $card;
        }

    }


    public function getHand(): array
    {
        return $this->hand;
    }


    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $graphicCard = new CardGraphic($card[0], $card[1]);
            $values[] = $graphicCard->getAsString();
        }
        return $values;
    }
}
