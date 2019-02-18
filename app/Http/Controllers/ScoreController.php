<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    //
    public $score = array();
    public $winner;
    public function getScore($hand){
        $suits = array();
        $cards = array();
        // separa em array de naipe e array de numeros das cartas
        for($i=0; $i<5; $i++){
            $explode = explode(",",$hand[$i]);
            array_push($suits, $explode[1]);
            array_push($cards, $explode[0]);
        }       

        $suit_frequency = array_count_values($suits);
        asort($cards);
        $number_frequency = array_count_values($cards);
        
        //se todas as cartas forem do mesmo naipe
        if($this->suitFrequency($suit_frequency,4) == 4){
            if(($cards[0] == 1) && ($cards[1] == 10) && ($this->isSequence($cards,1,4))){
                //royal flush
                array_push($this->score,10);
            }
            else{
                if(($cards[0] != 1) && $this->isSequence($cards,0,4)){
                    //straight flush
                    array_push($this->score,9);
                }
                if($this->numberFrequency($number_frequency,1) == 5){
                    //flush
                    array_push($this->score,6);
                }
                if($this->numberFrequency($number_frequency,4) == 4){
                    //quadra
                    array_push($this->score,8);
                }
                if(($this->numberFrequency($number_frequency,3) == 3) && ($this->numberFrequency($number_frequency,2) == 2)){
                    //full house
                    array_push($this->score,7);
                }
                if($this->numberFrequency($number_frequency,1) == 3){
                    //trinca
                    array_push($this->score,4);
                }
                if($this->numberFrequency($number_frequency,1) == 4){
                    //dois pares
                    array_push($this->score,3);
                }
                if($this->numberFrequency($number_frequency,1) == 2){
                    //um par
                    array_push($this->score,2);
                }
            }
        }
        else{
            if($this->isSequence($cards,0,4)){
                //sequencia
                array_push($this->score,5);
            }
            if($this->numberFrequency($number_frequency,4) == 4){
                //quadra
                array_push($this->score,8);
            }
            if(($this->numberFrequency($number_frequency,3) == 3) && ($this->numberFrequency($number_frequency,2) == 2)){
                //full house
                array_push($this->score,7);
            }
            if($this->numberFrequency($number_frequency,1) == 3){
                //trinca
                array_push($this->score,4);
            }
            if($this->numberFrequency($number_frequency,1) == 4){
                //dois pares
                array_push($this->score,3);
            }
            if($this->numberFrequency($number_frequency,1) == 2){
                //um par
                array_push($this->score,2);
            }
        } 
        if(!$this->score){
            array_push($this->score,1);
        }
        return $this->score;
    }

     //verificar se é uma sequencia
     public function isSequence($cards,$min,$max){
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
    public function numberFrequency($number_frequency, $compare_frequency){
        $cont =0;
        while ($index = current($number_frequency)) {
            if ($index == $compare_frequency) {
                $cont++;
            }
            next($number_frequency);
        }
        return $cont++;
    }
    public function suitFrequency($suit_frequency, $compare_frequency){
        $cont =0;
        
        while ($index = current($suit_frequency)) {
            if ($index == $compare_frequency) {
                $cont++;
            }
            next($suit_frequency);
        }
        return $cont++;
    }

    public function getWinner($score1,$score2){
        $player1 = asort($score1);
        $player2 = asort($score2);
        if($player1[count($player1) -1] > $player2[count($player2) -1]){
            $this->winner = 1;
        }
        elseif($player1[count($player1) -1] > $player2[count($player2) -1]){
            $this->winner = 2;
        }
        else{
            $this->winner = rand(1,2);
        }
        return $this->winner;
    }

}
