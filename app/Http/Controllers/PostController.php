<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('comment');
    }


    public function index(Request $request): View
    {
        return $this->postsView($request->search ? ['search' => $request->search] : [] );
    }

    public function postsByCategory(Category $category): View
    {
        return $this->postsView(['category' => $category]);
    }

    public function postsByTag(Tag $tag): View
    {
        return $this->postsView(['tag' => $tag]);
    }

    protected function postsView(array $filters): View
    {
        return view('home.index', [
            'posts' => Post::filters($filters)->latest()->paginate(4),
            'categorys'=> Category::all(),
        ]);
    }

    public function comment(Post $post, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'between:2,255'],
        ]);

        Comment::create([
            'content' => $validated['comment'],
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        return back()->withStatus('Commentaire publié !');
    }


    /**r
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) : View
    {
        $user_rating = Rating::where('post_id', $post->id)->where('user_id', Auth::id())->first();
        $post->viewed();
        $categorys = Category::all();
        return view('posts.show', ['post' => $post, 'user_rating' => $user_rating, 'categorys' => $categorys]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
