<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    protected function getHand($deck){
        // a quantidade de cartas de acordo com a quantidade de baralhos
        //o maior número é o coringa
        //Cada carta possui um representante numérico assim como cada naipe possui o seu
        $max_sort = ($deck * 53);
        $hand = array();

        for($i=0; $i < 5; $i++){
            //sorteia um numero entre todos os baralhos e o naipe
            $sorted_number = rand(1, $max_sort);
            $sorted_suit = rand(1,4);
            //verifica se há uma carta coringa
            if($sorted_number == $max_sort){
                array_push($hand,'joker');    
            }
            else{
                if($deck>1 && $sorted_number>56){
                    //transforma o numero sorteado em carta valida
                    $sorted_number = (($deck * 53) - $sorted_number);
                    
                }                
                array_push($hand,$sorted_number.','.$sorted_suit);                  
            }            
        }  

        return $hand;      
    }
    protected function getJoker(){
        $sorted_number = rand(1, 53);
        $sorted_suit = rand(1,4);
        $joker = $sorted_number . ',' . $sorted_suit;

        return $joker;
    }
    

   
}
