<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    //
    public function index()
    {
        $games = Game::orderBy('created_at', 'desc')->paginate(10);
        return $games;
    }
    public function create(GameRequest $game){
        $game = new Game;
        $game->winner = $request->winner;
        if($game->save()){
            return 'Partida salva com sucesso';
        }
        else{
            return 'Erro ao salvar partida';
        }

    }
}
