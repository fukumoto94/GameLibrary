<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Auth;

class GameController extends Controller
{
    public function _contruct(){
        $this->middleware(['auth', 'can:all']);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $games = Game::paginate(config('config.paginate'));
        return view('games.index', compact('games'));
     }

     /**
      * Show the form for creating a new resource.
      *
      *@return \Illuminate\Http\Response
      */
      public function create()
      {
          $game = new Game();
          return view('games.create', compact('game'));
      }

      /**
       * Store a newly created resource in storage.
       * 
       * @param \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
            $game = new Game();
            $game->name = $request->name;
            $game->description = $request->description;
            $game->started_at = $request->started_at;
            $game->finished_at = $request->finished_at;
            $game->user_id = $request->user_id;

            $game->save();
            return redirect('games');
      }

      /**
       * Display the specified resource.
       * 
       * @param int  $id
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {

      }

      /**
       * Show the form for edititing the specified resource.
       * 
       * @param int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit()
      {
        return view('games.edit', compact('game'));
      }

      public function profile()
      {

      }
      
      public function changePassword(Request $request)
      {

      }

      public function saveChangePassword(Request $request)
      {

      }

      /**
       * Update the specified resource in storage.
       * 
       * @param \Illuminate\Http\Request  $request
       * @param int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, $id)
      {

      }

      /**
       * Remove the specified resource from storage.
       * 
       * @param int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {

      }
}
