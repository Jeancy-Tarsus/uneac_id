<?php

namespace App\Http\Controllers;

use App\Models\Federation;
use Illuminate\Http\Request;

class FederationController extends Controller
{
    public function index(Request $request)
    {
        $query = Federation::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('sigle', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }

        $federations = $query
            ->withCount('members')
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('federations.index', compact('federations'));
    }

    public function create()
    {
        return redirect()->route('federations.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:federations,nom'],
            'sigle' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
        ], [
            'nom.required' => 'Le nom de la fédération est obligatoire.',
            'nom.unique' => 'Cette fédération existe déjà.',
        ]);

        $validated['active'] = $request->boolean('active');

        Federation::create($validated);

        return redirect()
            ->route('federations.index')
            ->with('success', 'Fédération ajoutée avec succès.');
    }

    public function show(Federation $federation)
    {
        $federation->loadCount('members');

        return view('federations.modals.show', compact('federation'));
    }

    public function edit(Federation $federation)
    {
        return view('federations.modals.edit', compact('federation'));
    }

    public function update(Request $request, Federation $federation)
    {
        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:255',
                'unique:federations,nom,' . $federation->id,
            ],
            'sigle' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
        ], [
            'nom.required' => 'Le nom de la fédération est obligatoire.',
            'nom.unique' => 'Cette fédération existe déjà.',
        ]);

        $validated['active'] = $request->boolean('active');

        $federation->update($validated);

        return redirect()
            ->route('federations.index')
            ->with('success', 'Fédération modifiée avec succès.');
    }

    public function destroy(Federation $federation)
    {
        if ($federation->members()->exists()) {
            return redirect()
                ->route('federations.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette fédération car elle est utilisée par un ou plusieurs membres.'
                );
        }

        $federation->delete();

        return redirect()
            ->route('federations.index')
            ->with('success', 'Fédération supprimée avec succès.');
    }
}
