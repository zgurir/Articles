<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Notifications\PostCreatedMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request) : View
    {
        return $this->postsView($request->search ? ['search' => $request->search] : [] );

    }

    public function postsBySortBy(Request $request): View
    {
        return $this->postsView($request->input('sort_by') ? ['sortBy' => $request->input('sort_by')] : [] );
    }


    protected function postsView(array $filters): View
    {
        $user = auth()->user();
        return view('admin.posts.index', [
            'posts' => Post::filters($filters)->where('user_id', $user->id)->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return $this->showForm();
    }

    protected function showForm(Post $post = new Post): View
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        return $this->save($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        return $this->save($request, $post);
    }

    protected function save(PostRequest $request, Post $post = null): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['thumbnail'])) {
            if (isset($post->thumbnail)) {
                Storage::delete($post->thumbnail);
            }
            $data['thumbnail'] = $data['thumbnail']->store('thumbnails');
        }

        $data['excerpt'] = Str::limit($data['content'], 150);


        $post = Post::updateOrCreate(['id' => $post?->id], $data);
        session()->put('status', $post->wasRecentlyCreated ? 'Post publié !' : 'Post mis à jour !');
        auth()->user()->notify(new PostCreatedMail($post));
        if($request->isMethod('post')){
            $post->user_id = Auth::id();
            $post->note = 0;
            $post->save();
        }
        $post->tags()->sync($data['tag_ids'] ?? null);

        return redirect()->route('posts.show', ['post' => $post]);

    }

    public function edit(Post $post): View
    {
        return $this->showForm($post);
    }

    /**
     * Update the specified resource in storage.

    /**
     * Remove the specified resource from storage.
     */
    public function deleteAll(Request $request)
    {
        // Vérifie que des éléments ont été sélectionnés
        $this->validate($request, [
            'post_id' => 'required|array|min:1',
            'post_id.*' => 'exists:posts,id',
        ]);

        // Supprime les éléments sélectionnés
        Post::destroy($request->post_id);

        // Redirige vers la page de liste avec un message de succès
        return redirect()->route('admin.posts.index')->withStatus('Les éléments sélectionnés ont été supprimés avec succès.');
    }

    public function destroy(Post $post)
    {
        Storage::delete($post->thumbnail);
        $post->delete();

        return redirect()->route('admin.posts.index')->withStatus('Post supprimé !');;
    }
}
