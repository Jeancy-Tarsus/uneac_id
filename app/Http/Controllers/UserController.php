<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Recherche par nom ou adresse e-mail
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");

            });
        }

        // Filtre par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }


    /**
     * Rediriger vers la liste.
     */
    public function create()
    {
        return redirect()->route('users.index');
    }


    /**
     * Enregistrer un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                Rule::in([
                    'super_admin',
                    'admin_uneac',
                ]),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ], [

            'name.required' =>
                'Le nom est obligatoire.',

            'email.required' =>
                'L’adresse e-mail est obligatoire.',

            'email.email' =>
                'Veuillez saisir une adresse e-mail valide.',

            'email.unique' =>
                'Cette adresse e-mail est déjà utilisée.',

            'role.required' =>
                'Le rôle est obligatoire.',

            'role.in' =>
                'Le rôle sélectionné est invalide.',

            'password.required' =>
                'Le mot de passe est obligatoire.',

            'password.min' =>
                'Le mot de passe doit contenir au moins 8 caractères.',

            'password.confirmed' =>
                'La confirmation du mot de passe ne correspond pas.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Création de l'utilisateur
        |--------------------------------------------------------------------------
        |
        | Le modèle User possède :
        |
        | 'password' => 'hashed'
        |
        | dans protected $casts.
        |
        | Laravel s'occupe donc automatiquement du hash.
        |
        */

        User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'role' => $validated['role'],

            'password' => $validated['password'],

        ]);


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Utilisateur créé avec succès.'
            );
    }


    /**
     * Afficher les informations d'un utilisateur.
     */
    public function show(User $user)
    {
        return response()->json([

            'id' => $user->id,

            'name' => $user->name,

            'email' => $user->email,

            'role' => $user->role,

            'created_at' => $user->created_at
                ? $user->created_at->format('d/m/Y')
                : null,

        ]);
    }


    /**
     * Récupérer les données pour la modale de modification.
     */
    public function edit(User $user)
    {
        return response()->json([

            'id' => $user->id,

            // IMPORTANT :
            // le nom vient bien de la colonne name
            'name' => $user->name,

            // l'adresse vient bien de la colonne email
            'email' => $user->email,

            // le rôle vient bien de la colonne role
            'role' => $user->role,

        ]);
    }


    /**
     * Modifier un utilisateur.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'role' => [
                'required',
                Rule::in([
                    'super_admin',
                    'admin_uneac',
                ]),
            ],

            /*
            |--------------------------------------------------------------------------
            | Mot de passe facultatif
            |--------------------------------------------------------------------------
            |
            | Si les deux champs sont vides :
            | → le mot de passe actuel reste inchangé.
            |
            | Si un nouveau mot de passe est saisi :
            | → la confirmation doit correspondre.
            |
            */

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

        ], [

            'name.required' =>
                'Le nom est obligatoire.',

            'email.required' =>
                'L’adresse e-mail est obligatoire.',

            'email.email' =>
                'Veuillez saisir une adresse e-mail valide.',

            'email.unique' =>
                'Cette adresse e-mail est déjà utilisée.',

            'role.required' =>
                'Le rôle est obligatoire.',

            'role.in' =>
                'Le rôle sélectionné est invalide.',

            'password.min' =>
                'Le mot de passe doit contenir au moins 8 caractères.',

            'password.confirmed' =>
                'La confirmation du mot de passe ne correspond pas.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Mise à jour des informations
        |--------------------------------------------------------------------------
        */

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->role = $validated['role'];


        /*
        |--------------------------------------------------------------------------
        | Modification du mot de passe
        |--------------------------------------------------------------------------
        |
        | On modifie uniquement si un nouveau mot de passe
        | a réellement été saisi.
        |
        */

        if (!empty($validated['password'])) {

            $user->password = $validated['password'];

        }


        $user->save();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Utilisateur modifié avec succès.'
            );
    }


    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Empêcher la suppression de son propre compte
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $user->id) {

            return redirect()
                ->route('users.index')
                ->with(
                    'error',
                    'Vous ne pouvez pas supprimer votre propre compte.'
                );
        }


        $user->delete();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Utilisateur supprimé avec succès.'
            );
    }
}
