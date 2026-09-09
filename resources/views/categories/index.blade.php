@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Catégories
        </span>
    </li>
@stop

@section('title', 'Catégories')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des catégories
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Catégories
            </li>

        </ol>

    </div>

@stop


@section('content')

    {{-- ========================================================= --}}
    {{-- BARRE DE RECHERCHE --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- ================================================= --}}
                {{-- TITRE --}}
                {{-- ================================================= --}}

                <div class="col-lg-3">

                    <h5 class="mb-0 fw-bold text-nowrap">

                        <i class="bi bi-tags me-2 text-primary"></i>

                        Liste des catégories

                    </h5>

                </div>


                {{-- ================================================= --}}
                {{-- RECHERCHE --}}
                {{-- ================================================= --}}

                <div class="col-lg-7">

                    <form method="GET"
                        action="{{ route('categories.index') }}">

                        <div class="row g-2">

                            {{-- RECHERCHE TEXTE --}}
                            <div class="col-md-5">

                                <input type="text"
                                    name="search"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Nom ou description...">

                            </div>


                            {{-- FILTRE STATUT --}}
                            <div class="col-md-3">

                                <select name="active"
                                        class="form-select">

                                    <option value="">
                                        Tous les statuts
                                    </option>

                                    <option value="1"
                                        {{ request('active') === '1' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ request('active') === '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                            </div>


                            {{-- BOUTONS --}}
                            <div class="col-md-4">

                                <div class="d-flex gap-2">

                                    {{-- RECHERCHER --}}
                                    <button type="submit"
                                            class="btn btn-primary flex-grow-1 text-nowrap">

                                        <i class="bi bi-search me-1"></i>

                                        Rechercher

                                    </button>


                                    {{-- EFFACER --}}
                                    @if(request('search') || request('active') !== null)

                                        <a href="{{ route('categories.index') }}"
                                        class="btn btn-outline-secondary flex-shrink-0"
                                        title="Effacer les filtres">

                                            <i class="bi bi-x-lg"></i>

                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- ================================================= --}}
                {{-- NOUVELLE CATÉGORIE --}}
                {{-- ================================================= --}}

                <div class="col-lg-2 text-lg-end">

                    <button type="button"
                            class="btn btn-primary text-nowrap"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAjouterCategorie">

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouvelle catégorie

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- TABLEAU DES CATÉGORIES --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            @if($categories->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th width="60">
                                    #
                                </th>

                                <th>
                                    Catégorie
                                </th>

                                <th>
                                    Description
                                </th>

                                <th>
                                    Membres
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th width="160"
                                    class="text-center">

                                    Actions

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($categories as $category)

                                <tr>

                                    {{-- NUMÉRO --}}
                                    <td class="text-muted">

                                        {{ $categories->firstItem() + $loop->index }}

                                    </td>


                                    {{-- NOM --}}
                                    <td>

                                        <div class="fw-semibold">

                                            <i class="bi bi-tag me-1 text-primary"></i>

                                            {{ $category->nom }}

                                        </div>

                                    </td>


                                    {{-- DESCRIPTION --}}
                                    <td>

                                        @if($category->description)

                                            <span>
                                                {{ $category->description }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                Non renseignée
                                            </span>

                                        @endif

                                    </td>


                                    {{-- NOMBRE DE MEMBRES --}}
                                    <td>

                                        <span class="badge text-bg-secondary">

                                            {{ $category->members_count ?? $category->members()->count() }}

                                            membre(s)

                                        </span>

                                    </td>


                                    {{-- STATUT --}}
                                    <td>

                                        @if($category->active)

                                            <span class="badge text-bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Active

                                            </span>

                                        @else

                                            <span class="badge text-bg-danger">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td class="text-center">

                                        {{-- VOIR --}}
                                        <button type="button"
                                                class="btn btn-sm btn-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalVoirCategorie{{ $category->id }}"
                                                title="Voir">

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        {{-- MODIFIER --}}
                                        <button type="button"
                                                class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalModifierCategorie{{ $category->id }}"
                                                title="Modifier">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>


                                        {{-- SUPPRIMER --}}
                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              class="form-suppression d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Supprimer">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>


                    {{-- ================================================= --}}
                    {{-- PAGINATION --}}
                    {{-- ================================================= --}}

                    @if($categories->hasPages())

                        <div class="position-relative p-3">

                            {{-- INFORMATIONS À GAUCHE --}}
                            <div class="text-muted small">

                                Affichage de

                                <strong>
                                    {{ $categories->firstItem() }}
                                </strong>

                                à

                                <strong>
                                    {{ $categories->lastItem() }}
                                </strong>

                                sur

                                <strong>
                                    {{ $categories->total() }}
                                </strong>

                                catégories

                            </div>


                            {{-- PAGINATION CENTRÉE --}}
                            <div class="d-flex justify-content-center mt-2">

                                {{ $categories->onEachSide(1)->links() }}

                            </div>

                        </div>

                    @endif

                </div>

            @else

                {{-- ================================================= --}}
                {{-- AUCUN RÉSULTAT --}}
                {{-- ================================================= --}}

                <div class="text-center py-5 px-3">

                    <div class="mb-3">

                        <i class="bi bi-tags text-muted"
                           style="font-size: 4rem;">
                        </i>

                    </div>


                    @if(request('search'))

                        <h5>
                            Aucune catégorie trouvée
                        </h5>

                        <p class="text-muted">

                            Aucun résultat pour :

                            <strong>
                                "{{ request('search') }}"
                            </strong>

                        </p>

                        <a href="{{ route('categories.index') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>

                            Réinitialiser

                        </a>

                    @else

                        <h5>
                            Aucune catégorie
                        </h5>

                        <p class="text-muted">
                            Aucune catégorie n'a encore été enregistrée.
                        </p>

                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAjouterCategorie">

                            <i class="bi bi-plus-lg me-1"></i>

                            Nouvelle catégorie

                        </button>

                    @endif

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL AJOUTER --}}
    {{-- ========================================================= --}}

    @include('categories.modals.create')


    {{-- ========================================================= --}}
    {{-- MODALS VOIR --}}
    {{-- ========================================================= --}}

    @foreach($categories as $category)

        @include('categories.modals.show', [
            'category' => $category
        ])

    @endforeach


    {{-- ========================================================= --}}
    {{-- MODALS MODIFIER --}}
    {{-- ========================================================= --}}

    @foreach($categories as $category)

        @include('categories.modals.edit', [
            'category' => $category
        ])

    @endforeach

@stop


{{-- ============================================================= --}}
{{-- SWEETALERT CSS --}}
{{-- ============================================================= --}}

@section('css')

    <link rel="stylesheet"
          href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">

@stop


{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

@section('js')

    {{-- Bootstrap 5 --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- SweetAlert --}}
    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
             * ======================================================
             * CONFIRMATION SUPPRESSION
             * ======================================================
             */

            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();

                    Swal.fire({

                        title: 'Êtes-vous sûr ?',

                        text: 'Cette catégorie sera définitivement supprimée.',

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#d33',

                        cancelButtonColor: '#6c757d',

                        confirmButtonText: 'Oui, supprimer',

                        cancelButtonText: 'Annuler',

                        reverseButtons: true

                    }).then(function (result) {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                });

            });


            /*
             * ======================================================
             * MESSAGES DE SESSION
             * ======================================================
             */

            @if(session('success'))

                Swal.fire({

                    icon: 'success',

                    title: 'Opération réussie',

                    text: @json(session('success')),

                    confirmButtonText: 'OK',

                    timer: 3000,

                    timerProgressBar: true

                });

            @endif


            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK'

                });

            @endif


            @if(session('warning'))

                Swal.fire({

                    icon: 'warning',

                    title: 'Attention',

                    text: @json(session('warning')),

                    confirmButtonText: 'OK'

                });

            @endif

        });

    </script>

@stop
