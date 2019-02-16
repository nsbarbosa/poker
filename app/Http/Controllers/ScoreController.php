<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    //
    protected function getScore($hand){
        $cards_suits = array();
        $cards_numbers = array();
        $score = array();
        // separa em array de naipe e array de numeros das cartas
        for($i=0; $i<5; $i++){
            $explode = explode(",",$hand[$i]);
            $suit = $explode[1];
            $card = $explode[0];
            array_push($cards_suits, $suit);
            array_push($cards_numbers, $card);
        }       

        $suit_frequency = array_count_values($cards_suits);
        $cards_numbers = asort($cards_numbers);
        $number_frequency = array_count_values($cards_numbers);
        
        //se todas as cartas forem do mesmo naipe
        if(suitFrequency($suit_frequency,4) == 4){
            if(($cards_numbers[0] == 1) && ($cards_numbers[1] == 10) && (isSequence($cards_numbers,1,4))){
                //royal flush
                array_push($score,10);
            }
            else{
                if(($cards_numbers[0] != 1) && isSequence($cards_numbers,0,4)){
                    //straight flush
                    array_push($score,9);
                }
                if(numberFrequency($number_frequency,1) == 5){
                    //flush
                    array_push($score,6);
                }
                if(numberFrequency($number_frequency,4) == 4){
                    //quadra
                    array_push($score,8);
                }
                if((numberFrequency($number_frequency,3) == 3) && (numberFrequency($number_frequency,2) == 2)){
                    //full house
                    array_push($score,7);
                }
                if(numberFrequency($number_frequency,1) == 3){
                    //trinca
                    array_push($score,4);
                }
                if(numberFrequency($number_frequency,1) == 4){
                    //dois pares
                    array_push($score,3);
                }
                if(numberFrequency($number_frequency,1) == 2){
                    //um par
                    array_push($score,2);
                }
            }
        }
        else{
            if(isSequence($cards_numbers,0,4)){
                //sequencia
                array_push($score,5);
            }
            if(numberFrequency($number_frequency,4) == 4){
                //quadra
                array_push($score,8);
            }
            if((numberFrequency($number_frequency,3) == 3) && (numberFrequency($number_frequency,2) == 2)){
                //full house
                array_push($score,7);
            }
            if(numberFrequency($number_frequency,1) == 3){
                //trinca
                array_push($score,4);
            }
            if(numberFrequency($number_frequency,1) == 4){
                //dois pares
                array_push($score,3);
            }
            if(numberFrequency($number_frequency,1) == 2){
                //um par
                array_push($score,2);
            }
        } 
        if(!$score){
            array_push($score,1);
        }
        return $score;
    }

     //verificar se é uma sequencia
     protected function isSequence($cards,$min,$max){
        $cont =0;
        for($i=$min; $i<$max; $i++){
            if($cards[$i]  == $cards[$i+1]+1){
                $cont++;
            }
        }
        if($cont++ == $max){
            return true;
        }
        else{
            return false;
        }
    }
    //o numero de frequencia das cartas
    protected function numberFrequency($number_frequency, $compare_frequency){
        $cont =0;
        //$frequency = array_count_values($cards);
        for($i=0;$i<5;$i++){
            if($number_frequency[$i] == $compare_frequency){
                $cont++;
            }            
        }
        return $cont++;
    }
    protected function suitFrequency($suit_frequency, $compare_frequency){
        $cont =0;
        for($i=0;$i<5;$i++){
            if($suit_frequency[$i] == $compare_frequency){
                $cont++;
            }            
        }
        return $cont++;
    }

    public function getWinner($score1,$score2){
        $player1 = asort($score1);
        $player2 = asort($score2);
        if($player1[count($player1) -1] > $player2[count($player2) -1]){
            $winner = 1;
        }
        elseif($player1[count($player1) -1] > $player2[count($player2) -1]){
            $winner = 2;
        }
        else{
            $winner = rand(1,2);
        }
        return $winner;
    }

}
