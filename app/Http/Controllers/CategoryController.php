<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Afficher la liste des catégories.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtre statut
        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }

        $categories = $query
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    /**
     * Formulaire de création.
     * Nous utiliserons le modal, donc cette méthode n'est pas nécessaire.
     */
    public function create()
    {
        return redirect()->route('categories.index');
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:categories,nom'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
        ], [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'nom.unique' => 'Cette catégorie existe déjà.',
        ]);

        $validated['active'] = $request->boolean('active');

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Afficher une catégorie.
     * Utilisé ici pour alimenter le modal de consultation.
     */
    public function show(Category $category)
    {
        return view('categories.modals.show', compact('category'));
    }

    /**
     * Formulaire de modification.
     * Nous utiliserons également un modal.
     */
    public function edit(Category $category)
    {
        return view('categories.modals.edit', compact('category'));
    }

    /**
     * Mettre à jour une catégorie.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:255',
                'unique:categories,nom,' . $category->id,
            ],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
        ], [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'nom.unique' => 'Cette catégorie existe déjà.',
        ]);

        $validated['active'] = $request->boolean('active');

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    /**
     * Supprimer une catégorie.
     */
    public function destroy(Category $category)
    {
        // On évite de supprimer une catégorie qui possède déjà des membres.
        if ($category->members()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle est utilisée par un ou plusieurs membres.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
