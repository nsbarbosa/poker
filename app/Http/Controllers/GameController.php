<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
//partida
class GameController extends Controller
{
    //
    public $hands;
    public $score;
    public $winner;
    public function __construct(){
        $this->hands = new HandsController();
    }
    
    public function newGame(){
        $hands  = $this->hands->getHands();
        $this->winner = $this->hands->getScore();       
        $this->saveGame();
        return array($hands,$this->winner);
    }
    public function listGames()
    {
        $games = Game::orderBy('created_at', 'desc')->get();
        return $games;
    }
    public function saveGame(){
        $game = new Game;
        $game->winner = $this->winner;
        if($game->save()){
            return 'Partida salva com sucesso';
        }
        else{
            return 'Erro ao salvar partida';
        }

    }
    
}
