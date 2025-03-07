<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request){

        $stars_rated = $request->input('rating');
        $post_id = $request->input('post_id');
        $post_check = Post::where('id', $post_id)->first();
        if($post_check){
            $existing_rating = Rating::where('user_id', Auth::id())->where('post_id', $post_id)->first(); #vérifier si l'utilisateur a déjà donner son avis sur ce poste
            if($existing_rating){
                $existing_rating->stars_rated = $stars_rated;
                $existing_rating->update();
            }
            else{
                Rating::create([
                    'user_id' => Auth::id(),
                    'post_id' => $post_id,
                    'stars_rated' => $stars_rated
                ]);
            }
            $avaerageRating = Rating::where('post_id', $post_id)->avg('stars_rated');
            $post = Post::findOrFail($post_id);
            $post->note = round($avaerageRating, 1);
            $post->save();
            return back()->withStatus('Merci pour votre avis pour ce post !');
        }
        else{
            return back()->withStatus('Post inexistant !');
        }
    }
}
