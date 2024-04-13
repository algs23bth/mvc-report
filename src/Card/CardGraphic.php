<?php

namespace App\Card;

class CardGraphic extends Card
{
    protected $suitToSymbol = array(
        "hearts" => '♥',
        "spades" => '♠',
        "diamonds" => '♦',
        "clubs" => '♣'
    );

    public function __construct(?string $suit = null, ?string $rank = null)
    {
        parent::__construct($suit, $rank);
    }

    public function getAsString(): string
    {
        return "[{$this->rank}{$this->suitToSymbol[$this->suit]}]";
    }
}
