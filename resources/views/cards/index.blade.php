@extends('adminlte::page')

@section('title', 'Cartes')


{{-- =========================================================
     BARRE SUPÉRIEURE
========================================================= --}}

@section('content_top_nav_left')

    <li class="nav-item d-none d-md-block">

        <span class="nav-link fw-semibold">

            <i class="bi bi-person-vcard-fill me-1"></i>

            Cartes

        </span>

    </li>

@stop


{{-- =========================================================
     EN-TÊTE
========================================================= --}}

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <div>

        <h1 class="fw-bold mb-1">
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


    @if(auth()->user()->role === 'super_admin')

        <button type="button"
                class="btn btn-primary btn-new-card"
                data-bs-toggle="modal"
                data-bs-target="#modalAjouterCarte">

            <i class="bi bi-plus-lg me-1"></i>

            Nouvelle carte

        </button>

    @endif

</div>

@stop



{{-- =========================================================
     CONTENU
========================================================= --}}

@section('content')

<div class="container-fluid">


    {{-- =====================================================
         LISTE DES ERREURS DE VALIDATION
         AFFICHÉES VIA SWEETALERT
    ====================================================== --}}

    @if($errors->any())

        <div id="validationErrors"
             data-errors='@json($errors->all())'>
        </div>

    @endif



    {{-- =====================================================
         FILTRES
    ====================================================== --}}

    <div class="card border-0 shadow-sm filter-card mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center mb-3">

                <div class="filter-icon me-3">

                    <i class="bi bi-funnel-fill"></i>

                </div>

                <div>

                    <h5 class="mb-0 fw-bold">
                        Recherche et filtres
                    </h5>

                    <small class="text-muted">
                        Recherchez et filtrez les cartes enregistrées.
                    </small>

                </div>

            </div>


            <form method="GET"
                  action="{{ route('cards.index') }}">

                <div class="row g-3">


                    {{-- RECHERCHE --}}

                    <div class="col-xl-5 col-lg-4">

                        <label class="form-label small fw-semibold">
                            Recherche
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search text-muted"></i>

                            </span>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="N° carte, N° membre, nom, téléphone...">

                        </div>

                    </div>



                    {{-- STATUT --}}

                    <div class="col-xl-2 col-lg-2">

                        <label class="form-label small fw-semibold">
                            Statut
                        </label>

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



                    {{-- PRODUCTION --}}

                    <div class="col-xl-2 col-lg-2">

                        <label class="form-label small fw-semibold">
                            Production
                        </label>

                        <select name="production"
                                class="form-select">

                            <option value="">
                                Toutes
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

                    </div>



                    {{-- RÉCEPTION UNEAC --}}

                    <div class="col-xl-2 col-lg-2">

                        <label class="form-label small fw-semibold">
                            Réception UNEAC
                        </label>

                        <select name="remise_uneac"
                                class="form-select">

                            <option value="">
                                Toutes
                            </option>

                            <option value="0"
                                {{ request('remise_uneac') === '0' ? 'selected' : '' }}>

                                Non reçue

                            </option>

                            <option value="1"
                                {{ request('remise_uneac') === '1' ? 'selected' : '' }}>

                                Reçue

                            </option>

                        </select>

                    </div>



                    {{-- BOUTONS --}}

                    <div class="col-xl-1 col-lg-2 d-flex align-items-end">

                        <div class="d-flex gap-2 w-100">

                            <button type="submit"
                                    class="btn btn-primary filter-submit"
                                    title="Rechercher">

                                <i class="bi bi-search"></i>

                            </button>


                            @if(
                                request('search') ||
                                request('status') ||
                                request('production') ||
                                request('remise_uneac') ||
                                request('remise_artiste')
                            )

                                <a href="{{ route('cards.index') }}"
                                   class="btn btn-outline-secondary"
                                   title="Réinitialiser">

                                    <i class="bi bi-arrow-counterclockwise"></i>

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>



    {{-- =====================================================
         LISTE DES CARTES
    ====================================================== --}}

    <div class="card border-0 shadow-sm cards-main-card">


        {{-- HEADER --}}

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <div class="card-list-icon me-3">

                        <i class="bi bi-person-vcard-fill"></i>

                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Liste des cartes
                        </h5>

                        <small class="text-muted">
                            Gestion et suivi des cartes UNEAC
                        </small>

                    </div>

                </div>


                <div class="total-badge">

                    <i class="bi bi-card-checklist me-1"></i>

                    {{ $cards->total() }}

                    carte{{ $cards->total() > 1 ? 's' : '' }}

                </div>

            </div>

        </div>



        {{-- =================================================
             TABLEAU
        ================================================== --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table cards-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="text-center col-number">
                                #
                            </th>

                            <th class="col-card">
                                Carte
                            </th>

                            <th class="col-member">
                                Membre
                            </th>

                            <th class="col-category">
                                Catégorie
                            </th>

                            <th class="col-federation">
                                Fédération
                            </th>

                            <th class="col-date">
                                Délivrance
                            </th>

                            <th class="col-date">
                                Expiration
                            </th>

                            <th class="col-status">
                                Statut
                            </th>

                            <th class="col-production">
                                Production
                            </th>

                            <th class="col-reception">
                                Réception UNEAC
                            </th>

                            <th class="col-delivery">
                                Remise artiste
                            </th>

                            <th class="text-center col-actions">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($cards as $card)

                            <tr>


                                {{-- =============================
                                     #
                                ============================== --}}

                                <td class="text-center">

                                    <span class="row-number">

                                        {{ $cards->firstItem() + $loop->index }}

                                    </span>

                                </td>



                                {{-- =============================
                                     CARTE
                                ============================== --}}

                                <td>

                                    <div class="card-number">

                                        {{ $card->numero_carte }}

                                    </div>

                                    <small class="text-muted">

                                        <i class="bi bi-qr-code me-1"></i>

                                        QR sécurisé

                                    </small>

                                </td>



                                {{-- =============================
                                     MEMBRE
                                ============================== --}}

                                <td>

                                    <div class="member-name">

                                        {{ $card->member->nom }}

                                        {{ $card->member->postnom }}

                                        {{ $card->member->prenom }}

                                    </div>

                                    <small class="text-muted">

                                        <i class="bi bi-person-badge me-1"></i>

                                        {{ $card->member->numero_membre }}

                                    </small>

                                </td>



                                {{-- =============================
                                     CATÉGORIE
                                ============================== --}}

                                <td>

                                    @if($card->member->category)

                                        <span class="category-text">

                                            {{ $card->member->category->nom }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>



                                {{-- =============================
                                     FÉDÉRATION
                                ============================== --}}

                                <td>

                                    @if($card->member->federation)

                                        <span class="federation-badge">

                                            {{ $card->member->federation->sigle
                                                ?? $card->member->federation->nom }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>



                                {{-- =============================
                                     DÉLIVRANCE
                                ============================== --}}

                                <td>

                                    <span class="date-value">

                                        {{ $card->date_delivrance?->format('d/m/Y') }}

                                    </span>

                                </td>



                                {{-- =============================
                                     EXPIRATION
                                ============================== --}}

                                <td>

                                    <span class="date-value">

                                        {{ $card->date_expiration?->format('d/m/Y') }}

                                    </span>

                                </td>



                                {{-- =============================
                                     STATUT
                                ============================== --}}

                                <td>

                                    @if($card->statut === 'active')

                                        <span class="status-badge status-active">

                                            <span class="status-dot"></span>

                                            Active

                                        </span>

                                    @elseif($card->statut === 'expiree')

                                        <span class="status-badge status-expired">

                                            <span class="status-dot"></span>

                                            Expirée

                                        </span>

                                    @elseif($card->statut === 'suspendue')

                                        <span class="status-badge status-suspended">

                                            <span class="status-dot"></span>

                                            Suspendue

                                        </span>

                                    @else

                                        <span class="status-badge status-revoked">

                                            <span class="status-dot"></span>

                                            Révoquée

                                        </span>

                                    @endif

                                </td>



                                {{-- =============================
                                     PRODUCTION
                                ============================== --}}

                                <td>

                                    @if($card->statut_production === 'produite')

                                        <span class="workflow-badge workflow-produced">

                                            <i class="bi bi-check-circle-fill"></i>

                                            Produite

                                        </span>

                                    @else

                                        <span class="workflow-badge workflow-pending">

                                            <i class="bi bi-clock-fill"></i>

                                            En attente

                                        </span>

                                    @endif

                                </td>



                                {{-- =============================
                                     RÉCEPTION UNEAC
                                ============================== --}}

                                <td>

                                    @if($card->remise_uneac)

                                        <span class="workflow-badge workflow-received">

                                            <i class="bi bi-building-check"></i>

                                            Reçue

                                        </span>

                                        @if($card->date_remise_uneac)

                                            <small class="date-small">

                                                {{ $card->date_remise_uneac->format('d/m/Y') }}

                                            </small>

                                        @endif

                                    @else

                                        <span class="workflow-badge workflow-not-received">

                                            <i class="bi bi-hourglass-split"></i>

                                            En attente

                                        </span>

                                    @endif

                                </td>



                                {{-- =============================
                                     REMISE ARTISTE
                                ============================== --}}

                                <td>

                                    @if($card->remise_artiste)

                                        <span class="workflow-badge workflow-delivered">

                                            <i class="bi bi-person-check-fill"></i>

                                            Remise

                                        </span>

                                        @if($card->date_remise_artiste)

                                            <small class="date-small">

                                                {{ $card->date_remise_artiste->format('d/m/Y') }}

                                            </small>

                                        @endif

                                    @elseif($card->remise_uneac)

                                        <span class="workflow-badge workflow-waiting">

                                            <i class="bi bi-person-walking"></i>

                                            À remettre

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>



                                {{-- =============================
                                     ACTIONS
                                ============================== --}}

                                <td class="text-center col-actions">

                                    <div class="action-buttons">


                                        {{-- =================================================
                                             SUPER ADMIN
                                        ================================================== --}}

                                        @if(auth()->user()->role === 'super_admin')


                                            {{-- VOIR --}}

                                            <button type="button"
                                                    class="action-btn action-view"
                                                    title="Voir"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalVoirCarte{{ $card->id }}">

                                                <i class="bi bi-eye"></i>

                                            </button>



                                            {{-- PRÉVISUALISER --}}

                                            <a href="{{ route('cards.preview', ['card' => $card->id]) }}"
                                               class="action-btn action-preview"
                                               title="Prévisualiser">

                                                <i class="bi bi-image"></i>

                                            </a>



                                            {{-- MODIFIER --}}

                                            <button type="button"
                                                    class="action-btn action-edit"
                                                    title="Modifier"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalModifierCarte{{ $card->id }}">

                                                <i class="bi bi-pencil"></i>

                                            </button>



                                            {{-- SUPPRIMER --}}

                                            <form method="POST"
                                                  action="{{ route('cards.destroy', ['card' => $card->id]) }}"
                                                  class="d-inline form-supprimer-carte">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="action-btn action-delete"
                                                        title="Supprimer">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>



                                            {{-- PRODUIRE --}}

                                            @if($card->statut_production === 'en_attente')

                                                <form method="POST"
                                                      action="{{ route('cards.produire', ['card' => $card->id]) }}"
                                                      class="d-inline form-produire-carte">

                                                    @csrf

                                                    <button type="submit"
                                                            class="action-btn action-produce"
                                                            title="Marquer comme produite">

                                                        <i class="bi bi-check-circle"></i>

                                                    </button>

                                                </form>



                                            {{-- RÉCEPTION UNEAC --}}

                                            @elseif(
                                                $card->statut_production === 'produite'
                                                && !$card->remise_uneac
                                            )

                                                <a href="{{ route('cards.reception') }}"
                                                   class="action-btn action-reception"
                                                   title="Réception UNEAC">

                                                    <i class="bi bi-box-arrow-in-down"></i>

                                                </a>



                                            {{-- REMISE ARTISTE --}}

                                            @elseif(
                                                $card->remise_uneac
                                                && !$card->remise_artiste
                                            )

                                                <a href="{{ route('cards.delivery') }}"
                                                   class="action-btn action-delivery"
                                                   title="Remise aux artistes">

                                                    <i class="bi bi-person-check"></i>

                                                </a>

                                            @endif

                                        @endif



                                        {{-- =================================================
                                             ADMIN UNEAC
                                        ================================================== --}}

                                        @if(auth()->user()->role === 'admin_uneac')

                                            @if(
                                                $card->remise_uneac
                                                && !$card->remise_artiste
                                            )

                                                <a href="{{ route('cards.delivery') }}"
                                                   class="action-btn action-delivery"
                                                   title="Remettre aux artistes">

                                                    <i class="bi bi-person-check"></i>

                                                </a>

                                            @endif

                                        @endif


                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="12"
                                    class="empty-state">

                                    <div class="empty-icon">

                                        <i class="bi bi-person-vcard"></i>

                                    </div>

                                    <h6 class="fw-bold mt-3">
                                        Aucune carte trouvée
                                    </h6>

                                    <p class="text-muted mb-0">
                                        Aucune carte ne correspond aux critères de recherche.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- =================================================
             PAGINATION
        ================================================== --}}

        @if($cards->hasPages())

            <div class="card-footer bg-white border-0 py-3">

                <div class="row align-items-center">

                    <div class="col-md-5">

                        <small class="text-muted">

                            Affichage de

                            <strong>
                                {{ $cards->firstItem() }}
                            </strong>

                            à

                            <strong>
                                {{ $cards->lastItem() }}
                            </strong>

                            sur

                            <strong>
                                {{ $cards->total() }}
                            </strong>

                            cartes

                        </small>

                    </div>


                    <div class="col-md-7">

                        <div class="d-flex justify-content-end">

                            {{ $cards->links() }}

                        </div>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>



{{-- =========================================================
     MODALS
========================================================= --}}

@if(auth()->user()->role === 'super_admin')

    @include('cards.modals.create', [
        'members' => $members
    ])

    @foreach($cards as $card)

        @include('cards.modals.show', [
            'card' => $card
        ])

        @include('cards.modals.edit', [
            'card' => $card
        ])

    @endforeach

@endif


@endsection



{{-- =========================================================
     CSS
========================================================= --}}

@section('css')

<link rel="stylesheet"
      href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">

<style>


/* =========================================================
   GÉNÉRAL
========================================================= */

body {

    background: #f5f7f6;

}


.btn-primary {

    background: #087f3f !important;

    border-color: #087f3f !important;

}


.btn-primary:hover {

    background: #066b35 !important;

    border-color: #066b35 !important;

}


.btn-success {

    background: #087f3f !important;

    border-color: #087f3f !important;

}


/* =========================================================
   NOUVELLE CARTE
========================================================= */

.btn-new-card {

    border-radius: 8px;

    padding: 9px 16px;

    font-weight: 600;

    box-shadow: 0 3px 8px rgba(8, 127, 63, .18);

}


/* =========================================================
   FILTRES
========================================================= */

.filter-card {

    border-radius: 10px;

}


.filter-icon,
.card-list-icon {

    width: 44px;

    height: 44px;

    border-radius: 10px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #e9f7ef;

    color: #087f3f;

    font-size: 19px;

}


.filter-submit {

    min-width: 42px;

}


.form-label {

    color: #343a40;

}


.form-control,
.form-select {

    border-color: #dee2e6;

}


.form-control:focus,
.form-select:focus {

    border-color: #087f3f;

    box-shadow: 0 0 0 .15rem rgba(8, 127, 63, .10);

}


/* =========================================================
   CARTE PRINCIPALE
========================================================= */

.cards-main-card {

    border-radius: 10px;

    overflow: hidden;

}


.total-badge {

    background: #f4f7f5;

    border: 1px solid #e1e7e3;

    color: #495057;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 600;

}


/* =========================================================
   TABLEAU
========================================================= */

.cards-table {

    width: 100%;

    min-width: 1250px;

    border-collapse: separate;

    border-spacing: 0;

    font-size: 14px;

}


.cards-table thead th {

    background: #f8faf9;

    color: #59636a;

    font-size: 12px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .035em;

    white-space: nowrap;

    padding: 14px 9px;

    border-bottom: 1px solid #e6ebe8;

}


.cards-table tbody td {

    padding: 13px 9px;

    border-bottom: 1px solid #f0f2f3;

    background: #fff;

}


.cards-table tbody tr {

    transition: .15s ease;

}


.cards-table tbody tr:hover td {

    background: #fbfdfc;

}


.col-number {

    width: 42px;

}


.col-card {

    width: 125px;

}


.col-member {

    width: 185px;

}


.col-category {

    width: 115px;

}


.col-federation {

    width: 95px;

}


.col-date {

    width: 90px;

}


.col-status {

    width: 90px;

}


.col-production {

    width: 105px;

}


.col-reception {

    width: 110px;

}


.col-delivery {

    width: 110px;

}


.col-actions {

    width: 165px;

}


/* =========================================================
   NUMÉRO
========================================================= */

.row-number {

    color: #899197;

    font-weight: 700;

}


.card-number {

    color: #087f3f;

    font-size: 14px;

    font-weight: 700;

    white-space: nowrap;

}


.member-name {

    max-width: 175px;

    color: #212529;

    font-weight: 600;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

}


.category-text {

    color: #495057;

}

.category-text { font-size: 13px; }


.federation-badge {

    display: inline-block;

    padding: 5px 8px;

    border-radius: 6px;

    background: #f2f5f3;

    color: #495057;

    font-size: 14px;

    font-weight: 700;

}


.date-value {

    color: #495057;

    font-size: 13px;

    white-space: nowrap;

}


.date-small {

    display: block;

    margin-top: 3px;

    color: #8a9298;

    font-size: 11px;

}


/* =========================================================
   STATUT
========================================================= */

.status-badge {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 5px 8px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 600;

    white-space: nowrap;

}


.status-dot {

    width: 6px;

    height: 6px;

    border-radius: 50%;

}


.status-active {

    color: #087f3f;

    background: #e8f7ee;

}


.status-active .status-dot {

    background: #087f3f;

}


.status-expired {

    color: #996c00;

    background: #fff6df;

}


.status-expired .status-dot {

    background: #d39e00;

}


.status-suspended {

    color: #5c636a;

    background: #eef0f2;

}


.status-suspended .status-dot {

    background: #6c757d;

}


.status-revoked {

    color: #b42318;

    background: #fdeaea;

}


.status-revoked .status-dot {

    background: #dc3545;

}


/* =========================================================
   WORKFLOW
========================================================= */

.workflow-badge {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 5px 7px;

    border-radius: 6px;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;

}


.workflow-produced {

    color: #087f3f;

    background: #e8f7ee;

}


.workflow-pending {

    color: #996c00;

    background: #fff6df;

}


.workflow-received {

    color: #1769aa;

    background: #e9f2ff;

}


.workflow-not-received {

    color: #6c757d;

    background: #f1f3f5;

}


.workflow-delivered {

    color: #087f3f;

    background: #e8f7ee;

}


.workflow-waiting {

    color: #996c00;

    background: #fff6df;

}


/* =========================================================
   ACTIONS TOUJOURS VISIBLES
   ========================================================= */

.cards-table th.col-actions,
.cards-table td.col-actions {
    position: sticky !important;
    right: 0 !important;
    z-index: 50 !important;
    width: 165px;
    min-width: 165px;
    max-width: 165px;
    background: #ffffff !important;
    box-shadow: -8px 0 16px rgba(0, 0, 0, .08);
}

.cards-table thead th.col-actions {
    z-index: 60 !important;
    background: #f8faf9 !important;
}

.cards-table tbody tr:hover td.col-actions {
    background: #fbfdfc !important;
}

.cards-table td.col-actions .action-buttons {
    position: relative;
    z-index: 61;
}

.cards-table thead th.col-actions {
    z-index: 30;
    background: #f8faf9;
}

.cards-table tbody tr:hover td.col-actions {
    background: #fbfdfc;
}

/* On réserve suffisamment de place aux boutons */
.cards-table .action-buttons {
    min-width: 145px;
}

/* Scroll horizontal propre sur petits écrans */
.table-responsive {
    position: relative;
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #cbd5cf transparent;
}

.table-responsive::-webkit-scrollbar {
    height: 7px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f5f7f6;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #cbd5cf;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #087f3f;
}

@media (max-width: 1400px) {
    .cards-table {
        min-width: 1180px;
    }

    .cards-table thead th,
    .cards-table tbody td {
        padding-left: 8px;
        padding-right: 8px;
    }
}

@media (max-width: 1100px) {
    .cards-table {
        min-width: 1120px;
        font-size: 13px;
    }

    .cards-table thead th {
        font-size: 11px;
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .cards-table th.col-actions,
    .cards-table td.col-actions {
        width: 155px;
        min-width: 155px;
        max-width: 155px;
    }

    .cards-table .action-buttons {
        min-width: 140px;
        gap: 4px;
    }

    .cards-table .action-btn {
        width: 30px;
        height: 30px;
        font-size: 13px;
    }
}


/* =========================================================
   ACTIONS
========================================================= */

.action-buttons {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 4px;

    white-space: nowrap;

}


.action-btn {

    width: 31px;

    height: 31px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 7px;

    border: 1px solid #dee2e6;

    background: #fff;

    text-decoration: none;

    padding: 0;

    font-size: 14px;

    transition: all .15s ease;

}


.action-btn:hover {

    transform: translateY(-1px);

    box-shadow: 0 2px 5px rgba(0,0,0,.08);

}


.action-view {

    color: #0d6efd;

}


.action-preview {

    color: #087f3f;

}


.action-edit {

    color: #996c00;

}


.action-delete {

    color: #dc3545;

}


.action-produce {

    color: #087f3f;

    background: #f1fbf5;

    border-color: #b9e2ca;

}

.action-produce:disabled {

    opacity: .65;

    cursor: wait;

    transform: none !important;

}


.action-reception {

    color: #1769aa;

    background: #f2f8ff;

    border-color: #bfd8f2;

}


.action-delivery {

    color: #087f3f;

    background: #f1fbf5;

    border-color: #b9e2ca;

}


/* =========================================================
   ÉTAT VIDE
========================================================= */

.empty-state {

    padding: 70px 20px !important;

    text-align: center;

}


.empty-icon {

    width: 65px;

    height: 65px;

    margin: auto;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #e9f7ef;

    color: #087f3f;

    font-size: 28px;

}


/* =========================================================
   MODAL CRÉATION
========================================================= */

.modal-header-green {

    background: linear-gradient(
        135deg,
        #087f3f,
        #0b9650
    );

    color: white;

    padding: 18px 22px;

}


.modal-header-green small {

    opacity: .85;

}


.modal-content {

    border-radius: 12px;

    overflow: hidden;

}


.creation-info {

    display: flex;

    align-items: flex-start;

    gap: 12px;

    padding: 13px 15px;

    background: #f0f8f3;

    border: 1px solid #d8ecdf;

    border-radius: 9px;

    color: #31583f;

    font-size: 12px;

}


.creation-info-icon {

    color: #087f3f;

    font-size: 18px;

}


.creation-info p {

    color: #6b747a;

}


/* =========================================================
   PAGINATION
========================================================= */

.pagination {

    margin-bottom: 0;

}


.pagination .page-link {

    color: #087f3f;

}


.pagination .page-item.active .page-link {

    background-color: #087f3f;

    border-color: #087f3f;

}


/* =========================================================
   RESPONSIVE
========================================================= */

</style>

@stop



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

@section('js')

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       SUCCESS
    ========================================================= */

    @if(session('success'))

        Swal.fire({

            icon: 'success',

            title: 'Opération réussie',

            text: @json(session('success')),

            confirmButtonText: 'OK',

            confirmButtonColor: '#087f3f',

            timer: 3000,

            timerProgressBar: true

        });

    @endif



    /* =========================================================
       ERREUR SESSION
    ========================================================= */

    @if(session('error'))

        Swal.fire({

            icon: 'error',

            title: 'Action impossible',

            text: @json(session('error')),

            confirmButtonText: 'OK',

            confirmButtonColor: '#087f3f'

        });

    @endif



    /* =========================================================
       ERREURS DE VALIDATION
    ========================================================= */

    const validationErrors =
        document.getElementById('validationErrors');


    if (validationErrors) {

        let errors = [];

        try {

            errors =
                JSON.parse(
                    validationErrors.dataset.errors
                );

        } catch (error) {

            console.error(
                'Erreur lecture validation:',
                error
            );

        }


        if (errors.length > 0) {

            Swal.fire({

                icon: 'error',

                title: 'Impossible d’effectuer l’opération',

                html: `
                    <div style="text-align:left">
                        <ul style="margin-bottom:0">
                            ${errors.map(error => `<li>${error}</li>`).join('')}
                        </ul>
                    </div>
                `,

                confirmButtonText: 'OK',

                confirmButtonColor: '#087f3f'

            });


            /*
             * Réouvre automatiquement le modal
             * après une erreur de validation.
             */

            const modalElement =
                document.getElementById(
                    'modalAjouterCarte'
                );


            if (modalElement) {

                const modal =
                    new bootstrap.Modal(
                        modalElement
                    );

                modal.show();

            }

        }

    }



    /* =========================================================
       SUPPRESSION
    ========================================================= */

    document
        .querySelectorAll('.form-supprimer-carte')
        .forEach(function (form) {

            form.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();


                    Swal.fire({

                        title: 'Supprimer la carte ?',

                        text:
                            'Cette action est irréversible.',

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonText:
                            'Oui, supprimer',

                        cancelButtonText:
                            'Annuler',

                        reverseButtons: true,

                        confirmButtonColor:
                            '#dc3545'

                    }).then(function (result) {

                        if (result.isConfirmed) {

                            const button = form.querySelector('button[type="submit"]');

                            if (button) {
                                button.disabled = true;
                                button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Traitement...';
                            }

                            // Soumission native robuste, même si un champ
                            // venait à masquer la méthode submit().
                            HTMLFormElement.prototype.submit.call(form);

                        }

                    });

                }
            );

        });



    /* =========================================================
       PRODUIRE
    ========================================================= */

    document
        .querySelectorAll('.form-produire-carte')
        .forEach(function (form) {

            form.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();


                    Swal.fire({

                        title: 'Marquer comme produite ?',

                        text:
                            'Confirmez-vous que cette carte a été physiquement imprimée ?',

                        icon: 'question',

                        showCancelButton: true,

                        confirmButtonText:
                            'Oui, produire',

                        cancelButtonText:
                            'Annuler',

                        reverseButtons: true,

                        confirmButtonColor:
                            '#087f3f'

                    }).then(function (result) {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                }
            );

        });



    /* =========================================================
       DATE EXPIRATION
       PETITE AIDE VISUELLE
    ========================================================= */

    const dateDelivrance =
        document.querySelector(
            '#modalAjouterCarte input[name="date_delivrance"]'
        );


    const dateExpiration =
        document.querySelector(
            '#modalAjouterCarte input[name="date_expiration"]'
        );


    if (dateDelivrance && dateExpiration) {

        dateDelivrance.addEventListener(
            'change',
            function () {

                dateExpiration.min =
                    this.value;

            }
        );

    }


});

</script>

@stop
