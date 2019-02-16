<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    protected function getHands(){
        //hands 1 e 2        
        $hands = array($this->setHand(), $this->setHand());               
        $links_hands = array($this->getLinkHands($hands), $hands);
        
        return $links_hands;      
    }

    protected function getLinkHands($hands){
        for($i=0; $i<2; $i++){
            for($j=0; $j<5; $j++){
                if($hands[$i][$j] == "joker"){
                    $hands[$i][$j] = "coringa.jpg";
                }
                else{
                    $explode = explode(",",$hands[$i][$j]);
                    if($explode[1] == 1){
                        $hands[$i][$j] = "paus/".$explode[0].".jpg";
                    }
                    if($explode[1] == 2){
                        $hands[$i][$j] = "ouros/".$explode[0].".jpg";
                    }
                    if($explode[1] == 3){
                        $hands[$i][$j] = "copas/".$explode[0].".jpg";
                    }
                    if($explode[1] == 4){
                        $hands[$i][$j] = "espadas/".$explode[0].".jpg";
                    }
                }
            }
        }
        return $hands;
    }

    protected function setHand(){
        //o maior número é o coringa
        //Cada carta possui um representante numérico assim como cada naipe possui o seu

        $hand = array();

        for($i=0; $i < 5; $i++){
            //sorteia um numero entre todos os baralhos e o naipe
            $sorted_number = rand(1, 14);
            $sorted_suit = rand(1,4);
            //verifica se há uma carta coringa
            if($sorted_number == 14){
                array_push($hand,'joker');    
            }
            else{
                array_push($hand,$sorted_number.','.$sorted_suit);                                
            }            
        }
        
        return $hand;
    }
    protected function getJoker(){
        $sorted_number = rand(1, 13);
        $sorted_suit = rand(1,4);

        if($sorted_suit == 1){
            $joker = "paus/".$sorted_number.".jpg";
        }
        if($sorted_suit == 2){
            $joker = "ouros/".$sorted_number.".jpg";
        }
        if($sorted_suit == 3){
            $joker = "copas/".$sorted_number.".jpg";
        }
        if($sorted_suit == 4){
            $joker = "espadas/".$sorted_number.".jpg";
        }

        return $joker;
    }   

}
