<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandsController extends Controller
{
    //
    public $hands;
    public $hand1 = array();
    public $hand2 = array();

    public function getHands(){

        for($i=0; $i<10; $i++){
            $card = new CardController();
            $card->suit = $card->getSuit();
            $card->value = $card->getValue();
            $card->image = $card->getImage($card->suit,$card->value);
            $hands[$i] = $card; 

            if($i<5){
                $this->hand1[$i] = $card->value.','.$card->suit;
            }
            if($i>=5){
                $this->hand2[$i-5] = $card->value.','.$card->suit;
            }
                        
        }
        
        return $hands;

    }
    public function getScore(){
        $score = new ScoreController();
        $score1 = $score->getScore($this->hand1);
        $score2 = $score->getScore($this->hand2);
        $winner = $score->getWinner($score1,$score2);
        
        return $winner;
    }
}
