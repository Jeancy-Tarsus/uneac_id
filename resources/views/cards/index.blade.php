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
    {{-- MESSAGES --}}
    {{-- ================================================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ================================================= --}}
    {{-- RECHERCHE / FILTRES --}}
    {{-- ================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            {{-- EN-TÊTE --}}

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0 fw-bold">

                    <i class="bi bi-person-vcard-fill text-primary me-2"></i>

                    Liste des cartes

                </h5>


                <button type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterCarte">

                    <i class="bi bi-plus-lg me-1"></i>

                    Nouvelle carte

                </button>

            </div>


            {{-- FILTRES --}}

            <form method="GET"
                  action="{{ route('cards.index') }}">

                <div class="row g-2">


                    {{-- RECHERCHE --}}

                    <div class="col-lg-5">

                        <input type="text"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="N° carte, N° membre, nom, téléphone...">

                    </div>


                    {{-- STATUT --}}

                    <div class="col-lg-3">

                        <select name="status"
                                class="form-select">

                            <option value="">
                                Tous les statuts
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


                    {{-- BOUTONS --}}

                    <div class="col-lg-4">

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary flex-grow-1 text-nowrap">

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>


                            @if(
                                request('search') ||
                                request('status')
                            )

                                <a href="{{ route('cards.index') }}"
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


    {{-- ================================================= --}}
    {{-- TABLEAU --}}
    {{-- ================================================= --}}

    <div class="card shadow-sm border-0">

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


                                {{-- ACTIONS --}}

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
                                              action="{{ route('cards.destroy', $card) }}"
                                              class="form-supprimer-carte d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                        <a href="{{ route('cards.preview', $card) }}"
   class="btn btn-sm btn-success"
   title="Voir la carte">

    <i class="bi bi-person-vcard"></i>

</a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
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
{{-- MODALS --}}
{{-- ================================================= --}}

@include('cards.modals.create')

@foreach($cards as $card)

    @include('cards.modals.show', [
        'card' => $card
    ])

    @include('cards.modals.edit', [
        'card' => $card
    ])

@endforeach


@endsection


{{-- ================================================= --}}
{{-- SCRIPTS --}}
{{-- ================================================= --}}

@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    // Suppression carte

    document.querySelectorAll('.form-supprimer-carte')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();

                if (confirm('Voulez-vous vraiment supprimer cette carte ?')) {

                    form.submit();

                }

            });

        });

});

</script>

@stop
