@extends('adminlte::page')

@section('title', 'Cartes')

@section('content_top_nav_left')

    <li class="nav-item d-none d-md-block">

        <span class="nav-link fw-semibold">
            Cartes
        </span>

    </li>

@stop


@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="mb-1">
                Gestion des cartes
            </h1>

            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">

                    <a href="{{ route('dashboard') }}">
                        Tableau de bord
                    </a>

                </li>

                <li class="breadcrumb-item active">
                    Cartes
                </li>

            </ol>

        </div>

    </div>

@stop


@section('content')

<div class="container-fluid">


    {{-- ================================================= --}}
    {{-- TABLEAU --}}
    {{-- ================================================= --}}

    <div class="card shadow-sm border-0">

        {{-- HEADER --}}

        <div class="card-header bg-white">

            <div class="row align-items-center g-2">

                {{-- TITRE --}}

                <div class="col-lg-3">

                    <h5 class="mb-0 fw-bold">

                        <i class="bi bi-person-vcard-fill text-primary me-2"></i>

                        Liste des cartes

                    </h5>

                </div>


                {{-- RECHERCHE --}}

                <div class="col-lg-7">

                    <form method="GET"
                          action="{{ route('cards.index') }}">

                        <div class="row g-2">

                            {{-- RECHERCHE --}}

                            <div class="col-md-5">

                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="N° carte, N° membre, nom, téléphone...">

                            </div>


                            {{-- STATUT --}}

                            <div class="col-md-3">

                                <select name="status"
                                        class="form-select">

                                    <option value="">
                                        Statut
                                    </option>

                                    <option value="active"
                                        {{ request('status') === 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="expiree"
                                        {{ request('status') === 'expiree' ? 'selected' : '' }}>
                                        Expirée
                                    </option>

                                    <option value="suspendue"
                                        {{ request('status') === 'suspendue' ? 'selected' : '' }}>
                                        Suspendue
                                    </option>

                                    <option value="revoquee"
                                        {{ request('status') === 'revoquee' ? 'selected' : '' }}>
                                        Révoquée
                                    </option>

                                </select>

                            </div>


                            {{-- PRODUCTION --}}

                            <div class="col-md-4">

                                <div class="d-flex gap-2">

                                    <select name="production"
                                            class="form-select">

                                        <option value="">
                                            Production
                                        </option>

                                        <option value="en_attente"
                                            {{ request('production') === 'en_attente' ? 'selected' : '' }}>
                                            En attente
                                        </option>

                                        <option value="produite"
                                            {{ request('production') === 'produite' ? 'selected' : '' }}>
                                            Produite
                                        </option>

                                    </select>


                                    <select name="remise"
                                            class="form-select">

                                        <option value="">
                                            Remise
                                        </option>

                                        <option value="0"
                                            {{ request('remise') === '0' ? 'selected' : '' }}>
                                            Non remise
                                        </option>

                                        <option value="1"
                                            {{ request('remise') === '1' ? 'selected' : '' }}>
                                            Remise
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        {{-- BOUTONS FILTRE --}}

                        <div class="mt-2 d-flex justify-content-end gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>


                            @if(
                                request('search') ||
                                request('status') ||
                                request('production') ||
                                request('remise')
                            )

                                <a href="{{ route('cards.index') }}"
                                   class="btn btn-outline-secondary">

                                    <i class="bi bi-x-lg me-1"></i>

                                    Réinitialiser

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- AJOUT --}}

                <div class="col-lg-2 text-lg-end">

                    @if(auth()->user()->role === 'super_admin')

                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAjouterCarte">

                            <i class="bi bi-plus-lg me-1"></i>

                            Nouvelle carte

                        </button>

                    @endif

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- TABLE --}}
        {{-- ================================================= --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-3">
                                #
                            </th>

                            <th>
                                Carte
                            </th>

                            <th>
                                Membre
                            </th>

                            <th>
                                Catégorie
                            </th>

                            <th>
                                Fédération
                            </th>

                            <th>
                                Délivrance
                            </th>

                            <th>
                                Expiration
                            </th>

                            <th>
                                Statut
                            </th>

                            <th>
                                Production
                            </th>

                            <th>
                                Remise
                            </th>

                            <th class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($cards as $card)

                            <tr>


                                {{-- NUMÉRO --}}

                                <td class="px-3">

                                    {{ $cards->firstItem() + $loop->index }}

                                </td>


                                {{-- CARTE --}}

                                <td>

                                    <div class="fw-semibold">

                                        {{ $card->numero_carte }}

                                    </div>

                                    <small class="text-muted">

                                        QR sécurisé

                                    </small>

                                </td>


                                {{-- MEMBRE --}}

                                <td>

                                    <div class="fw-semibold">

                                        {{ $card->member->nom }}
                                        {{ $card->member->postnom }}
                                        {{ $card->member->prenom }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $card->member->numero_membre }}

                                    </small>

                                </td>


                                {{-- CATÉGORIE --}}

                                <td>

                                    {{ $card->member->category->nom ?? '—' }}

                                </td>


                                {{-- FÉDÉRATION --}}

                                <td>

                                    {{ $card->member->federation->sigle
                                        ?? $card->member->federation->nom
                                        ?? '—' }}

                                </td>


                                {{-- DÉLIVRANCE --}}

                                <td>

                                    {{ $card->date_delivrance?->format('d/m/Y') }}

                                </td>


                                {{-- EXPIRATION --}}

                                <td>

                                    {{ $card->date_expiration?->format('d/m/Y') }}

                                </td>


                                {{-- STATUT --}}

                                <td>

                                    @if($card->statut === 'active')

                                        <span class="badge text-bg-success">
                                            Active
                                        </span>

                                    @elseif($card->statut === 'expiree')

                                        <span class="badge text-bg-warning">
                                            Expirée
                                        </span>

                                    @elseif($card->statut === 'suspendue')

                                        <span class="badge text-bg-secondary">
                                            Suspendue
                                        </span>

                                    @else

                                        <span class="badge text-bg-danger">
                                            Révoquée
                                        </span>

                                    @endif

                                </td>


                                {{-- PRODUCTION --}}

                                <td>

                                    @if($card->statut_production === 'produite')

                                        <span class="badge text-bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Produite

                                        </span>

                                    @else

                                        <span class="badge text-bg-warning">

                                            <i class="bi bi-clock me-1"></i>

                                            En attente

                                        </span>

                                    @endif

                                </td>


                                {{-- REMISE --}}

                                <td>

                                    @if($card->remise)

                                        <span class="badge text-bg-primary">

                                            <i class="bi bi-person-check me-1"></i>

                                            Remise

                                        </span>


                                        @if($card->date_remise)

                                            <small class="d-block text-muted mt-1">

                                                {{ $card->date_remise->format('d/m/Y') }}

                                            </small>

                                        @endif

                                    @else

                                        <span class="badge text-bg-secondary">

                                            Non remise

                                        </span>

                                    @endif

                                </td>


                                {{-- ================================================= --}}
                                {{-- ACTIONS --}}
                                {{-- ================================================= --}}

                                <td class="text-center">

                                    <div class="btn-group"
                                         role="group">


                                        {{-- VOIR --}}

                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Voir"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalVoirCarte{{ $card->id }}">

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        {{-- ================================================= --}}
                                        {{-- SUPER ADMIN --}}
                                        {{-- ================================================= --}}

                                        @if(auth()->user()->role === 'super_admin')


                                            {{-- PRÉVISUALISER --}}

                                            <a href="{{ route('cards.preview', ['card' => $card->id]) }}"
                                               class="btn btn-sm btn-outline-success"
                                               title="Prévisualiser et télécharger">

                                                <i class="bi bi-image"></i>

                                            </a>


                                            {{-- MODIFIER --}}

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-warning"
                                                    title="Modifier"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalModifierCarte{{ $card->id }}">

                                                <i class="bi bi-pencil"></i>

                                            </button>


                                            {{-- SUPPRIMER --}}

                                            <form method="POST"
                                                  action="{{ route('cards.destroy', ['card' => $card->id]) }}"
                                                  class="form-supprimer-carte d-inline">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Supprimer">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>


                                            {{-- ================================================= --}}
                                            {{-- PRODUIRE --}}
                                            {{-- ================================================= --}}

                                            @if($card->statut_production === 'en_attente')

                                                <form method="POST"
                                                      action="{{ route('cards.produce', ['card' => $card->id]) }}"
                                                      class="form-produire-carte d-inline">

                                                    @csrf

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-success"
                                                            title="Marquer comme produite">

                                                        <i class="bi bi-check-circle"></i>

                                                    </button>

                                                </form>

                                            @endif


                                            {{-- ================================================= --}}
                                            {{-- ANNULER REMISE --}}
                                            {{-- ================================================= --}}

                                            @if($card->remise)

                                                <form method="POST"
                                                      action="{{ route('cards.cancel-delivery', ['card' => $card->id]) }}"
                                                      class="form-annuler-remise d-inline">

                                                    @csrf

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-secondary"
                                                            title="Annuler la remise">

                                                        <i class="bi bi-arrow-counterclockwise"></i>

                                                    </button>

                                                </form>

                                            @endif

                                        @endif


                                        {{-- ================================================= --}}
                                        {{-- REMETTRE --}}
                                        {{-- SUPER ADMIN + ADMIN UNEAC --}}
                                        {{-- ================================================= --}}

                                        @if(
                                            auth()->user()->role === 'super_admin'
                                            ||
                                            auth()->user()->role === 'admin_uneac'
                                        )

                                            @if(
                                                $card->statut_production === 'produite'
                                                &&
                                                !$card->remise
                                            )

                                                <form method="POST"
                                                      action="{{ route('cards.deliver', ['card' => $card->id]) }}"
                                                      class="form-remettre-carte d-inline">

                                                    @csrf

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-primary"
                                                            title="Marquer comme remise">

                                                        <i class="bi bi-person-check"></i>

                                                    </button>

                                                </form>

                                            @endif

                                        @endif

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="11"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-person-vcard fs-1 d-block mb-3"></i>

                                        <h6 class="fw-semibold">
                                            Aucune carte trouvée
                                        </h6>

                                        <p class="mb-0">
                                            Aucune carte ne correspond aux critères de recherche.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}

        @if($cards->hasPages())

            <div class="card-footer bg-white">

                <div class="row align-items-center">

                    <div class="col-md-4">

                        <small class="text-muted">

                            Affichage de
                            {{ $cards->firstItem() }}
                            à
                            {{ $cards->lastItem() }}
                            sur
                            {{ $cards->total() }}
                            cartes

                        </small>

                    </div>


                    <div class="col-md-8">

                        <div class="d-flex justify-content-end">

                            {{ $cards->links() }}

                        </div>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- ================================================= --}}
{{-- MODAL AJOUTER --}}
{{-- ================================================= --}}

@if(auth()->user()->role === 'super_admin')

    @include('cards.modals.create')

@endif


{{-- ================================================= --}}
{{-- MODALS VOIR / MODIFIER --}}
{{-- ================================================= --}}

@foreach($cards as $card)

    @include('cards.modals.show', [
        'card' => $card
    ])

    @if(auth()->user()->role === 'super_admin')

        @include('cards.modals.edit', [
            'card' => $card
        ])

    @endif

@endforeach


@endsection


{{-- ================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ================================================= --}}

@section('js')


{{-- ================================================= --}}
{{-- SWEETALERT LOCAL --}}
{{-- ================================================= --}}

<link rel="stylesheet"
      href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">

<script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | VÉRIFICATION
    |--------------------------------------------------------------------------
    */

    if (typeof Swal === 'undefined') {

        console.error(
            'SweetAlert2 n\'a pas été chargé.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | MESSAGE SUCCÈS
    |--------------------------------------------------------------------------
    */

    @if(session('success'))

        Swal.fire({

            icon: 'success',

            title: 'Opération réussie',

            text: @json(session('success')),

            confirmButtonText: 'OK',

            confirmButtonColor: '#087f3f'

        });

    @endif


    /*
    |--------------------------------------------------------------------------
    | MESSAGE ERREUR
    |--------------------------------------------------------------------------
    */

    @if(session('error'))

        Swal.fire({

            icon: 'error',

            title: 'Action impossible',

            text: @json(session('error')),

            confirmButtonText: 'OK'

        });

    @endif


    /*
    |--------------------------------------------------------------------------
    | SUPPRESSION
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.form-supprimer-carte')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();


                Swal.fire({

                    title: 'Supprimer la carte ?',

                    text: 'Cette action est irréversible.',

                    icon: 'warning',

                    showCancelButton: true,

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
    |--------------------------------------------------------------------------
    | PRODUIRE
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.form-produire-carte')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();


                Swal.fire({

                    title: 'Marquer comme produite ?',

                    text: 'Confirmez-vous que la carte a été physiquement imprimée ?',

                    icon: 'question',

                    showCancelButton: true,

                    confirmButtonText: 'Oui, produire',

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
    |--------------------------------------------------------------------------
    | REMETTRE
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.form-remettre-carte')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();


                Swal.fire({

                    title: 'Confirmer la remise',

                    text: 'Confirmez-vous que cette carte a été remise à l’artiste ?',

                    icon: 'question',

                    showCancelButton: true,

                    confirmButtonText: 'Oui, remettre',

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
    |--------------------------------------------------------------------------
    | ANNULER LA REMISE
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.form-annuler-remise')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();


                Swal.fire({

                    title: 'Annuler la remise ?',

                    text: 'La carte sera de nouveau considérée comme non remise.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonText: 'Oui, annuler',

                    cancelButtonText: 'Non',

                    reverseButtons: true

                }).then(function (result) {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });

});

</script>

@stop
