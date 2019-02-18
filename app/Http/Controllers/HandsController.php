<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandsController extends Controller
{
    //
    public $hands;

    public function getHands(){

        for($i=0; $i<10; $i++){
            $card = new CardController();
            $card->suit = $card->getSuit();
            $card->value = $card->getValue();
            $card->image = $card->getImage($card->suit,$card->value);
            $hands[$i] = $card; 

            if($i<5){
                $hand1[$i] = $card->value.','.$card->suit;
            }
            if($i>=5){
                $hand2[$i] = $card->value.','.$card->suit;
            }
                        
        }
        $score = new ScoreController();
        $score1 = $score->getScore($hand1);
        $score2 = $score->getScore($hand2);
        $winner = getWinner($score1,$score2);
        array_push($hands,$winner);
        return $hands;

    }
}
