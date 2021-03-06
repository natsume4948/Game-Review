<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Game;

use App\Review;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if (\Auth::check()) { 
            $user = User::orderBy('id', 'desc')->paginate(10);
            
            $games = Game::orderBy('id', 'desc')->paginate(10);
            
            $reviews = Review::orderBy('id', 'desc')->paginate(10);
            
            
            $data = [
                'user' => $user,
                'games' => $games,
                'reviews' => $reviews,
            ];
        }
        return view('users.show', $data);
    }
    
    
    public function create($id)
    {
        if(\Auth::user()->hasReview($id)) {
            return redirect('/');
            
        }else {
            $user = \Auth::user();
        
        $review = new Review;
        
        $game = Game::findOrFail($id);
        
        return view('reviews.score', [
            'review' => $review,
            'game' => $game,
            ]);
        }
    }
    
    public function store(Request $request)
    {   
        //dd($reviews);
         if(\Auth::user()->hasReview($request->game_id)) {
            return redirect('/');
            
        }else {
        $request->validate([
        'score' => 'required|max:255',
        'content' => 'required|max:255',
        ]);
        $review = new Review;
        $review->user_id = \Auth::id();
        $review->content = $request->content;
        $review->score = $request->score;
        $review->game_id = $request->game_id;
        $review->save();

        return redirect('myreviews/{user}');;
        }
    }
    public function destroy($id)
    {
        $review = \App\Review::findOrFail($id);
        if (\Auth::id() === $review->user_id) {
            $review->delete();
        }
        return back();
    }
}
