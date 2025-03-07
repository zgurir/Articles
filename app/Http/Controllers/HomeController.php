<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        return $this->postsView($request->search ? ['search' => $request->search] : [] );
    }


    public function majmdp(): View
    {
        return view('home.majmdp');
    }

    public function profile(): View
    {   $pays = collect(['', 'France', 'Espagne', 'Usa', 'Maroc', 'Autre']);
        $user = Auth::user();
        // Diviser le nom complet (deux mots ou plus) en un tableau de mots
        $nameParts = explode(' ', $user->name);

        $name = array_shift($nameParts); // extrait et renvoie le premier élément du tableau, c'est-à-dire le nom. Après cette opération, le tableau $nameParts contiendra tous les autres mots (qui seront le prénom).
        $prenom = implode(' ', $nameParts); // recomposer le reste des mots (dans le tableau $nameParts) en une seule chaîne de texte, séparée par des espaces. Cela correspond au prénom.
        return view('home.profile', ['user' => $user, 'name' => $name, 'prenom' => $prenom, 'pays' => $pays]);
    }

    public function updateProfile(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'username' => 'nullable|string|between:3,255|unique:users,username,' . auth()->id(),
            'profession' => 'nullable|string|between:3,255',
            'pays' => 'nullable|string|between:3,255',
            'name' => 'string|between:3,20',
            'prenom' => 'string|between:3,20',
            'email' => 'email|unique:users,email,' . auth()->id(),
            'adresse' => 'nullable|string|between:3,255',
            'ville' => 'nullable|string|between:3,255',
            'city_other' => 'nullable|string|between:2,255',
            'infos' => 'nullable|string|between:3,255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour l'image
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        $validatedData['name'] = $validatedData['name'] . ' ' . $validatedData['prenom'];

        // Mettre à jour les champs dans la base de données
        if ($request->pays === 'Autre') {
            // Si la ville saisie par l'utilisateur est fournie, on la stocke dans 'city'
            $validatedData['ville'] = $request->city_other;
        } else {
            // Sinon, on stocke simplement la ville sélectionnée dans la liste
            $validatedData['ville'] = $request->ville;
        }

        // Si une photo est uploadée, on la stocke et on met à jour le chemin dans la base de données
        if (isset($validatedData['photo'])) {
            $validatedData['photo'] = $validatedData['photo']->store('photos');

        }
        $user->update($validatedData);

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('home.profile')->withStatus('Profil mis à jour avec succès.');;
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) use ($user) {
                    if (! Hash::check($value, $user->password)) {
                        $fail("Le :attribute est erroné.");
                    }
                },
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('home.majmdp')->withStatus('Mot de passe modifié');
    }

    protected function postsView(array $filters): View
    {
        return view('home.index', [
            'posts' => Post::filters($filters)->latest()->paginate(4),
            'categorys'=> Category::all(),
        ]);
    }

}
