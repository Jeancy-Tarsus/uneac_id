<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Federation;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Liste des membres.
     */
    public function index(Request $request)
    {
        $query = Member::with([
            'category',
            'federation',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('numero_membre', 'like', "%{$search}%")
                    ->orWhere('nom', 'like', "%{$search}%")
                    ->orWhere('postnom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('profession_artistique', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre catégorie
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre fédération
        |--------------------------------------------------------------------------
        */

        if ($request->filled('federation_id')) {

            $query->where(
                'federation_id',
                $request->federation_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre statut
        |--------------------------------------------------------------------------
        */

        if ($request->filled('statut')) {

            $query->where(
                'statut',
                $request->statut
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Résultats
        |--------------------------------------------------------------------------
        */

        $members = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Données des filtres
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('active', true)
            ->orderBy('nom')
            ->get();

        $federations = Federation::where('active', true)
            ->orderBy('nom')
            ->get();

        return view('members.index', compact(
            'members',
            'categories',
            'federations'
        ));
    }


    /**
     * Formulaire de création.
     *
     * Nous utilisons un modal.
     */
    public function create()
    {
        return redirect()->route('members.index');
    }


    /**
     * Enregistrer un nouveau membre.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'postnom' => [
                'nullable',
                'string',
                'max:100',
            ],

            'prenom' => [
                'required',
                'string',
                'max:100',
            ],

            'date_naissance' => [
                'nullable',
                'date',
            ],

            'sexe' => [
                'nullable',
                'in:M,F',
            ],

            'lieu_naissance' => [
                'nullable',
                'string',
                'max:255',
            ],

            'nationalite' => [
                'nullable',
                'string',
                'max:100',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'domicile' => [
                'nullable',
                'string',
            ],

            'profession_artistique' => [
                'nullable',
                'string',
                'max:255',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'federation_id' => [
                'nullable',
                'exists:federations,id',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'date_adhesion' => [
                'nullable',
                'date',
            ],

            'statut' => [
                'required',
                'in:actif,suspendu,inactif',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Numéro membre automatique
        |--------------------------------------------------------------------------
        */

        $lastMember = Member::latest('id')->first();

        $nextNumber = $lastMember
            ? $lastMember->id + 1
            : 1;

        $validated['numero_membre'] =
            'UNEAC-CG-26' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


        /*
        |--------------------------------------------------------------------------
        | Nationalité par défaut
        |--------------------------------------------------------------------------
        */

        if (empty($validated['nationalite'])) {

            $validated['nationalite'] = 'Congolaise';
        }


        /*
        |--------------------------------------------------------------------------
        | Date d'adhésion
        |--------------------------------------------------------------------------
        */

        if (empty($validated['date_adhesion'])) {

            $validated['date_adhesion'] = now()->toDateString();
        }


        /*
        |--------------------------------------------------------------------------
        | Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $validated['photo'] =
                $request->file('photo')
                ->store('members', 'uneac');
        }


        /*
        |--------------------------------------------------------------------------
        | Création
        |--------------------------------------------------------------------------
        */

        Member::create($validated);


        return redirect()
            ->route('members.index')
            ->with(
                'success',
                'Membre enregistré avec succès.'
            );
    }


    /**
     * Afficher un membre.
     */
    public function show(Member $member)
    {
        $member->load([
            'category',
            'federation',
            'card',
        ]);

        return view(
            'members.modals.show',
            compact('member')
        );
    }


    /**
     * Modifier un membre.
     */
    public function edit(Member $member)
    {
        $categories = Category::where('active', true)
            ->orderBy('nom')
            ->get();

        $federations = Federation::where('active', true)
            ->orderBy('nom')
            ->get();

        return view(
            'members.modals.edit',
            compact(
                'member',
                'categories',
                'federations'
            )
        );
    }


    /**
     * Mettre à jour un membre.
     */
    public function update(
        Request $request,
        Member $member
    ) {

        $validated = $request->validate([

            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'postnom' => [
                'nullable',
                'string',
                'max:100',
            ],

            'prenom' => [
                'required',
                'string',
                'max:100',
            ],

            'date_naissance' => [
                'nullable',
                'date',
            ],

            'sexe' => [
                'nullable',
                'in:M,F',
            ],

            'lieu_naissance' => [
                'nullable',
                'string',
                'max:255',
            ],

            'nationalite' => [
                'nullable',
                'string',
                'max:100',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'domicile' => [
                'nullable',
                'string',
            ],

            'profession_artistique' => [
                'nullable',
                'string',
                'max:255',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'federation_id' => [
                'nullable',
                'exists:federations,id',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'date_adhesion' => [
                'nullable',
                'date',
            ],

            'statut' => [
                'required',
                'in:actif,suspendu,inactif',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Nouvelle photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $validated['photo'] =
                $request->file('photo')
                ->store('members', 'uneac');
        }


        $member->update($validated);


        return redirect()
            ->route('members.index')
            ->with(
                'success',
                'Membre modifié avec succès.'
            );
    }


    /**
     * Supprimer un membre.
     */
    public function destroy(Member $member)
    {
        /*
        |--------------------------------------------------------------------------
        | Suppression de la carte associée
        |--------------------------------------------------------------------------
        */

        if ($member->card) {

            $member->card->delete();
        }


        $member->delete();


        return redirect()
            ->route('members.index')
            ->with(
                'success',
                'Membre supprimé avec succès.'
            );
    }
}
