<?php

namespace App\Card;

class Card
{
    protected $suit;
    protected $rank;

    protected $suits = array("hearts", "clubs", "diamonds", "spades");
    protected $ranks = array("1","2","3","4","5","6","7","8","9","10","A","J","Q","K");


    public function __construct(?string $suit = null, ?string $rank = null)
    {
        $this->suit = $suit ?? array_rand($this->suits);
        $this->rank = $rank ?? array_rand($this->rank);
    }

    public function getRank(): int
    {
        return $this->rank;
    }


    public function getSuit(): int
    {
        return $this->suit;
    }

    public function getAsString(): string
    {
        return "{$this->rank} {$this->suit}";
    }


}
