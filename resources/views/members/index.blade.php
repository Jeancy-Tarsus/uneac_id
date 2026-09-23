@extends('adminlte::page')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content_top_nav_left')

    <li class="nav-item">
        <span class="nav-link fw-bold">
            Membres
        </span>
    </li>

@stop


@section('title', 'Membres')


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des membres
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">

                <a href="{{ route('dashboard') }}">

                    <i class="bi bi-house-door me-1"></i>

                    Accueil

                </a>

            </li>

            <li class="breadcrumb-item active">

                Membres

            </li>

        </ol>

    </div>

@stop


{{-- ========================================================= --}}
{{-- CONTENT --}}
{{-- ========================================================= --}}

@section('content')


    {{-- ========================================================= --}}
    {{-- BARRE DE RECHERCHE ET FILTRES --}}
    {{-- ========================================================= --}}

   <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            {{-- ================================================= --}}
            {{-- EN-TÊTE --}}
            {{-- ================================================= --}}

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0 fw-bold text-nowrap">

                    <i class="bi bi-people me-2 text-primary"></i>

                    Liste des membres

                </h5>


                {{-- NOUVEAU MEMBRE --}}

                <button type="button"
                        class="btn btn-primary text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterMembre">

                    <i class="bi bi-plus-lg me-1"></i>

                    Nouveau membre

                </button>

            </div>


            {{-- ================================================= --}}
            {{-- FILTRES --}}
            {{-- ================================================= --}}

            <form method="GET"
                action="{{ route('members.index') }}">

                <div class="row g-2">


                    {{-- RECHERCHE --}}

                    <div class="col-lg-3">

                        <input type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="N° membre, nom...">

                    </div>


                    {{-- CATÉGORIE --}}

                    <div class="col-lg-3">

                        <select name="category_id"
                                class="form-select">

                            <option value="">
                                Toutes les catégories
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->nom }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- FÉDÉRATION --}}

                    <div class="col-lg-2">

                        <select name="federation_id"
                                class="form-select">

                            <option value="">
                                Toutes les fédérations
                            </option>

                            @foreach($federations as $federation)

                                <option value="{{ $federation->id }}"
                                    {{ request('federation_id') == $federation->id ? 'selected' : '' }}>

                                    {{ $federation->sigle ?? $federation->nom }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- STATUT --}}

                    <div class="col-lg-2">

                        <select name="statut"
                                class="form-select">

                            <option value="">
                                Tous les statuts
                            </option>

                            <option value="actif"
                                {{ request('statut') === 'actif' ? 'selected' : '' }}>

                                Actif

                            </option>

                            <option value="suspendu"
                                {{ request('statut') === 'suspendu' ? 'selected' : '' }}>

                                Suspendu

                            </option>

                            <option value="inactif"
                                {{ request('statut') === 'inactif' ? 'selected' : '' }}>

                                Inactif

                            </option>

                        </select>

                    </div>


                    {{-- ACTIONS --}}

                    <div class="col-lg-2">

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary flex-grow-1 text-nowrap">

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>


                            @if(
                                request('search') ||
                                request('category_id') ||
                                request('federation_id') ||
                                request('statut')
                            )

                                <a href="{{ route('members.index') }}"
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

    </div>

    {{-- ========================================================= --}}
    {{-- TABLEAU --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">


            @if($members->count() > 0)


                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">


                        {{-- ================================================= --}}
                        {{-- THEAD --}}
                        {{-- ================================================= --}}

                        <thead class="table-light">

                            <tr>

                                <th width="60">
                                    Matricule
                                </th>

                                <th>
                                    Membre
                                </th>

                                <th>
                                    Profession
                                </th>

                                <th>
                                    Catégorie
                                </th>

                                <th>
                                    Fédération
                                </th>

                                <th>
                                    Téléphone
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th width="150"
                                    class="text-center members-actions-head">

                                    Actions

                                </th>

                            </tr>

                        </thead>


                        {{-- ================================================= --}}
                        {{-- TBODY --}}
                        {{-- ================================================= --}}

                        <tbody>


                            @foreach($members as $member)

                                <tr>


                                    {{-- maric --}}
                                    <td class="text-muted">

                                        {{ $member->numero_membre }}

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- MEMBRE --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        <div class="d-flex align-items-center">


                                            {{-- PHOTO --}}
                                            @if($member->photo)

                                                <img src="{{ app()->environment('production') ? Storage::disk('uneac')->temporaryUrl($member->photo, now()->addMinutes(30)) : asset('storage/' . $member->photo) }}"
                                                     alt="Photo de {{ $member->prenom }}"
                                                     class="rounded-circle me-2"
                                                     width="42"
                                                     height="42"
                                                     style="object-fit: cover;">

                                            @else

                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                                     style="width:42px;height:42px;">

                                                    <i class="bi bi-person text-muted"></i>

                                                </div>

                                            @endif


                                            {{-- NOM --}}
                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $member->nom }}

                                                    {{ $member->postnom }}

                                                    {{ $member->prenom }}

                                                </div>


                                                @if($member->email)

                                                    <small class="text-muted">

                                                        {{ $member->email }}

                                                    </small>

                                                @endif

                                            </div>

                                        </div>

                                    </td>

                                    {{-- ================================================= --}}
                                    {{-- PROFESSION --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        @if($member->profession_artistique)

                                            {{ $member->profession_artistique }}

                                        @else

                                            <span class="text-muted">
                                                Non renseignée
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- CATÉGORIE --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        @if($member->category)

                                            {{ $member->category->nom }}

                                        @else

                                            <span class="text-muted">
                                                Non renseignée
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- FÉDÉRATION --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        @if($member->federation)

                                            {{ $member->federation->sigle
                                                ?? $member->federation->nom }}

                                        @else

                                            <span class="text-muted">
                                                Non renseignée
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- TÉLÉPHONE --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        @if($member->telephone)

                                            {{ $member->telephone }}

                                        @else

                                            <span class="text-muted">
                                                Non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- STATUT --}}
                                    {{-- ================================================= --}}

                                    <td>

                                        @if($member->statut === 'actif')

                                            <span class="badge text-bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Actif

                                            </span>

                                        @elseif($member->statut === 'suspendu')

                                            <span class="badge text-bg-warning">

                                                <i class="bi bi-pause-circle me-1"></i>

                                                Suspendu

                                            </span>

                                        @else

                                            <span class="badge text-bg-danger">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Inactif

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ================================================= --}}
                                    {{-- ACTIONS --}}
                                    {{-- ================================================= --}}

                                    <td class="text-center members-actions-cell">

                                        <div class="members-action-buttons">

                                            {{-- VOIR --}}
                                            <button type="button"
                                                    class="members-action-btn members-action-view"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalVoirMembre{{ $member->id }}"
                                                    title="Voir">

                                                <i class="bi bi-eye"></i>

                                            </button>

                                            {{-- MODIFIER --}}
                                            <button type="button"
                                                    class="members-action-btn members-action-edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalModifierMembre{{ $member->id }}"
                                                    title="Modifier">

                                                <i class="bi bi-pencil-square"></i>

                                            </button>

                                            {{-- SUPPRIMER --}}
                                            <form action="{{ route('members.destroy', $member) }}"
                                                  method="POST"
                                                  class="form-suppression d-inline">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="members-action-btn members-action-delete"
                                                        title="Supprimer">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach


                        </tbody>

                    </table>


                    {{-- ================================================= --}}
                    {{-- PAGINATION --}}
                    {{-- ================================================= --}}

                    @if($members->hasPages())

                        <div class="position-relative p-3">


                            <div class="text-muted small">

                                Affichage de

                                <strong>
                                    {{ $members->firstItem() }}
                                </strong>

                                à

                                <strong>
                                    {{ $members->lastItem() }}
                                </strong>

                                sur

                                <strong>
                                    {{ $members->total() }}
                                </strong>

                                membres

                            </div>


                            <div class="d-flex justify-content-center mt-2">

                                {{ $members->onEachSide(1)->links() }}

                            </div>


                        </div>

                    @endif


                </div>


            @else


                {{-- ================================================= --}}
                {{-- AUCUN MEMBRE --}}
                {{-- ================================================= --}}

                <div class="text-center py-5 px-3">


                    <div class="mb-3">

                        <i class="bi bi-people text-muted"
                           style="font-size: 4rem;">
                        </i>

                    </div>


                    @if(
                        request('search') ||
                        request('category_id') ||
                        request('federation_id') ||
                        request('statut')
                    )


                        <h5>
                            Aucun membre trouvé
                        </h5>


                        <p class="text-muted">

                            Aucun membre ne correspond
                            aux critères sélectionnés.

                        </p>


                        <a href="{{ route('members.index') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>

                            Réinitialiser les filtres

                        </a>


                    @else


                        <h5>
                            Aucun membre
                        </h5>


                        <p class="text-muted">

                            Aucun membre n'a encore été enregistré.

                        </p>


                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAjouterMembre">

                            <i class="bi bi-plus-lg me-1"></i>

                            Nouveau membre

                        </button>


                    @endif


                </div>


            @endif


        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- MODAL AJOUTER --}}
    {{-- ========================================================= --}}

    @include('members.modals.create')



    {{-- ========================================================= --}}
    {{-- MODALS VOIR --}}
    {{-- ========================================================= --}}

    @foreach($members as $member)

        @include('members.modals.show', [
            'member' => $member
        ])

    @endforeach



    {{-- ========================================================= --}}
    {{-- MODALS MODIFIER --}}
    {{-- ========================================================= --}}

    @foreach($members as $member)

        @include('members.modals.edit', [
            'member' => $member,
            'categories' => $categories,
            'federations' => $federations
        ])

    @endforeach


@stop



{{-- ========================================================= --}}
{{-- CSS --}}
{{-- ========================================================= --}}

@section('css')

    <link rel="stylesheet"
          href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">

    <style>

        /*
         * Empêche certains éléments du tableau
         * de casser la mise en page.
         */

        .table td,
        .table th {
            vertical-align: middle;
        }


        /*
         * =====================================================
         * BOUTONS D'ACTION — DESIGN UNEAC
         * Compatible avec les thèmes clair et sombre AdminLTE
         * =====================================================
         */

        .members-actions-head,
        .members-actions-cell {
            white-space: nowrap;
        }

        .members-action-buttons {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            white-space: nowrap;
        }

        .members-action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            border: 1px solid var(--bs-border-color);
            background: var(--bs-body-bg);
            font-size: 14px;
            text-decoration: none;
            transition: all .15s ease;
        }

        .members-action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, .10);
        }

        /* Voir */
        .members-action-view {
            color: #0d6efd;
            background: rgba(13, 110, 253, .08);
            border-color: rgba(13, 110, 253, .20);
        }

        .members-action-view:hover {
            color: #0a58ca;
            background: rgba(13, 110, 253, .14);
        }

        /* Modifier */
        .members-action-edit {
            color: #996c00;
            background: rgba(153, 108, 0, .08);
            border-color: rgba(153, 108, 0, .20);
        }

        .members-action-edit:hover {
            color: #795800;
            background: rgba(153, 108, 0, .14);
        }

        /* Supprimer */
        .members-action-delete {
            color: #dc3545;
            background: rgba(220, 53, 69, .08);
            border-color: rgba(220, 53, 69, .20);
        }

        .members-action-delete:hover {
            color: #b02a37;
            background: rgba(220, 53, 69, .14);
        }

        /*
         * En mode sombre, on garde les mêmes couleurs UNEAC
         * mais les boutons suivent le fond AdminLTE.
         */
        [data-bs-theme="dark"] .members-action-btn {
            background: var(--bs-tertiary-bg);
            border-color: var(--bs-border-color);
        }

        [data-bs-theme="dark"] .members-action-view {
            color: #6ea8fe;
            background: rgba(110, 168, 254, .10);
            border-color: rgba(110, 168, 254, .22);
        }

        [data-bs-theme="dark"] .members-action-edit {
            color: #e0b44c;
            background: rgba(224, 180, 76, .10);
            border-color: rgba(224, 180, 76, .22);
        }

        [data-bs-theme="dark"] .members-action-delete {
            color: #ea868f;
            background: rgba(234, 134, 143, .10);
            border-color: rgba(234, 134, 143, .22);
        }


        /*
         * Modal membre
         */

        #modalAjouterMembre .modal-body {
            scrollbar-width: thin;
        }


        /*
         * Erreurs Laravel
         */

        .alert-danger ul {
            margin-bottom: 0;
        }

    </style>

@stop



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@section('js')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /*
             * =====================================================
             * SUPPRESSION
             * =====================================================
             */

            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();


                    Swal.fire({

                        title: 'Êtes-vous sûr ?',

                        text: 'Ce membre sera définitivement supprimé.',

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
             * =====================================================
             * MESSAGE DE SUCCÈS
             * =====================================================
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



            /*
             * =====================================================
             * MESSAGE D'ERREUR SESSION
             * =====================================================
             */

            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK'

                });

            @endif



            /*
             * =====================================================
             * RÉOUVERTURE DU MODAL APRÈS ERREUR
             * =====================================================
             *
             * Exemple :
             * photo trop volumineuse
             * email incorrect
             * champ obligatoire vide
             *
             */

            @if($errors->any())

                const modalElement =
                    document.getElementById('modalAjouterMembre');


                if (modalElement) {

                    const modal =
                        new bootstrap.Modal(modalElement);

                    modal.show();

                }

            @endif


        });

    </script>


@stop
