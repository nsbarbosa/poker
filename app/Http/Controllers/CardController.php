<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    //valor, naipe, imagem
    public $suit;
    public $value;
    public $image;
    //public $hands;

    public function getSuit(){
        $suit = rand(1,4);
        return $suit;
    }
    public function getImage($suit,$value){
            if($suit == 1){
                $image ="paus/".$value.".jpg";
            }
            if($suit == 2){
                $image ="ouros/".$value.".jpg";
            }
            if($suit == 3){
                $image ="copas/".$value.".jpg";
            }
            if($suit == 4){
                $image ="espadas/".$value.".jpg";
            }
        return $image;
    }

    public function getValue(){
        $value = rand(1, 13);
        return $value;
    } 

}
