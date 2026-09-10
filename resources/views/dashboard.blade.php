@extends('adminlte::page')

@section('title', 'Tableau de bord')


@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="fw-bold mb-1">
                Tableau de bord
            </h1>

            <p class="text-muted mb-0">
                Vue d'ensemble de la plateforme UNEAC ID.
            </p>

        </div>


        <div>

            <span class="badge bg-success px-3 py-2">

                <i class="bi bi-circle-fill me-1"
                   style="font-size: 7px;"></i>

                Système opérationnel

            </span>

        </div>

    </div>

@stop



@section('content')

<div class="container-fluid px-0">


    {{-- =========================================================
         STATISTIQUES PRINCIPALES
    ========================================================== --}}

    <div class="row">


        {{-- TOTAL MEMBRES --}}
        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Membres
                            </p>

                            <h2 class="fw-bold mb-0">

                                {{ number_format($totalMembers, 0, ',', ' ') }}

                            </h2>

                        </div>


                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-people-fill fs-2 text-primary"></i>

                        </div>

                    </div>


                    <div class="mt-3">

                        <small class="text-success">

                            <i class="bi bi-person-plus-fill"></i>

                            {{ $newMembersThisMonth }}
                            nouveau{{ $newMembersThisMonth > 1 ? 'x' : '' }}
                            ce mois

                        </small>

                    </div>

                </div>

            </div>

        </div>



        {{-- CARTES ACTIVES --}}
        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Cartes actives
                            </p>

                            <h2 class="fw-bold mb-0">

                                {{ number_format($activeCards, 0, ',', ' ') }}

                            </h2>

                        </div>


                        <div class="bg-success bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-person-vcard-fill fs-2 text-success"></i>

                        </div>

                    </div>


                    <div class="mt-3">

                        <small class="text-success">

                            <i class="bi bi-check-circle-fill"></i>

                            Cartes actuellement valides

                        </small>

                    </div>

                </div>

            </div>

        </div>



        {{-- CARTES EXPIRÉES --}}
        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Cartes expirées
                            </p>

                            <h2 class="fw-bold mb-0">

                                {{ number_format($expiredCards, 0, ',', ' ') }}

                            </h2>

                        </div>


                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-calendar-x-fill fs-2 text-warning"></i>

                        </div>

                    </div>


                    <div class="mt-3">

                        <small class="text-warning">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                            À renouveler

                        </small>

                    </div>

                </div>

            </div>

        </div>



        {{-- CARTES SUSPENDUES --}}
        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Cartes suspendues
                            </p>

                            <h2 class="fw-bold mb-0">

                                {{ number_format($suspendedCards, 0, ',', ' ') }}

                            </h2>

                        </div>


                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-slash-circle-fill fs-2 text-danger"></i>

                        </div>

                    </div>


                    <div class="mt-3">

                        <small class="text-danger">

                            <i class="bi bi-exclamation-circle-fill"></i>

                            Vérification requise

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         DEUXIÈME LIGNE — STRUCTURES
    ========================================================== --}}

    <div class="row">


        {{-- MEMBRES ACTIFS --}}
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">

                            <i class="bi bi-person-check-fill fs-3 text-success"></i>

                        </div>

                        <div>

                            <p class="text-muted mb-1">
                                Membres actifs
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ number_format($activeMembers, 0, ',', ' ') }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- CATÉGORIES --}}
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">

                            <i class="bi bi-tags-fill fs-3 text-warning"></i>

                        </div>

                        <div>

                            <p class="text-muted mb-1">
                                Catégories artistiques
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ number_format($totalCategories, 0, ',', ' ') }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- FÉDÉRATIONS --}}
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">

                            <i class="bi bi-diagram-3-fill fs-3 text-primary"></i>

                        </div>

                        <div>

                            <p class="text-muted mb-1">
                                Fédérations
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ number_format($totalFederations, 0, ',', ' ') }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         ACTIONS RAPIDES
    ========================================================== --}}

    <div class="row">


        <div class="col-12 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-1">

                        <i class="bi bi-lightning-charge-fill text-warning me-2"></i>

                        Actions rapides

                    </h5>

                    <p class="text-muted small mb-0">

                        Accédez rapidement aux principales fonctionnalités.

                    </p>

                </div>


                <div class="card-body px-4 pb-4">

                    <div class="row">


                        {{-- MEMBRES --}}
                        <div class="col-lg-4 col-md-4 mb-3">

                            <a href="{{ route('members.index') }}"
                               class="btn btn-primary w-100 py-3">

                                <i class="bi bi-person-plus-fill fs-4 d-block mb-2"></i>

                                Gestion des membres

                            </a>

                        </div>


                        {{-- CARTES --}}
                        <div class="col-lg-4 col-md-4 mb-3">

                            <a href="{{ route('cards.index') }}"
                               class="btn btn-outline-primary w-100 py-3">

                                <i class="bi bi-person-vcard-fill fs-4 d-block mb-2"></i>

                                Gestion des cartes

                            </a>

                        </div>


                        {{-- CATÉGORIES --}}
                        <div class="col-lg-4 col-md-4 mb-3">

                            <a href="{{ route('categories.index') }}"
                               class="btn btn-outline-success w-100 py-3">

                                <i class="bi bi-tags-fill fs-4 d-block mb-2"></i>

                                Catégories artistiques

                            </a>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         MEMBRES RÉCENTS + INFORMATIONS
    ========================================================== --}}

    <div class="row">


        {{-- MEMBRES RÉCENTS --}}
        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow-sm h-100">


                <div class="card-header bg-white border-0 pt-4 px-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">

                                <i class="bi bi-people-fill text-primary me-2"></i>

                                Membres récents

                            </h5>

                            <p class="text-muted small mb-0">
                                Derniers membres enregistrés.
                            </p>

                        </div>


                        <a href="{{ route('members.index') }}"
                           class="btn btn-sm btn-outline-primary">

                            Voir tout

                        </a>

                    </div>

                </div>


                <div class="card-body px-4">


                    @forelse($recentMembers as $member)

                        <div class="d-flex align-items-center py-3
                                    {{ !$loop->last ? 'border-bottom' : '' }}">


                            {{-- PHOTO --}}
                            <div class="me-3">

                                @if($member->photo)

                                    <img
                                        src="{{ asset('storage/' . $member->photo) }}"
                                        alt="{{ $member->nom }}"
                                        class="rounded-circle"
                                        style="
                                            width: 45px;
                                            height: 45px;
                                            object-fit: cover;
                                        "
                                    >

                                @else

                                    <div
                                        class="rounded-circle bg-success bg-opacity-10
                                               d-flex align-items-center justify-content-center"
                                        style="
                                            width: 45px;
                                            height: 45px;
                                        "
                                    >

                                        <i class="bi bi-person-fill text-success"></i>

                                    </div>

                                @endif

                            </div>


                            {{-- IDENTITÉ --}}
                            <div class="flex-grow-1">

                                <strong>

                                    {{ $member->nom }}
                                    {{ $member->postnom }}
                                    {{ $member->prenom }}

                                </strong>

                                <div>

                                    <small class="text-muted">

                                        {{ $member->numero_membre }}

                                        @if($member->category)
                                            • {{ $member->category->nom }}
                                        @endif

                                    </small>

                                </div>

                            </div>


                            {{-- STATUT --}}
                            <div>

                                @if($member->statut === 'actif')

                                    <span class="badge bg-success">
                                        Actif
                                    </span>

                                @elseif($member->statut === 'suspendu')

                                    <span class="badge bg-warning text-dark">
                                        Suspendu
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactif
                                    </span>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5 text-muted">

                            <i class="bi bi-people fs-1 d-block mb-2"></i>

                            Aucun membre enregistré.

                        </div>

                    @endforelse


                </div>

            </div>

        </div>



        {{-- INFORMATIONS UNEAC ID --}}
        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow-sm h-100">


                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-info-circle-fill text-primary me-2"></i>

                        UNEAC ID

                    </h5>

                </div>


                <div class="card-body px-4">


                    {{-- SÉCURITÉ --}}
                    <div class="d-flex align-items-center mb-4">

                        <div class="me-3">

                            <i class="bi bi-shield-check fs-2 text-success"></i>

                        </div>

                        <div>

                            <strong>
                                Identification sécurisée
                            </strong>

                            <br>

                            <small class="text-muted">

                                QR Code unique pour chaque carte

                            </small>

                        </div>

                    </div>


                    {{-- MOBILE --}}
                    <div class="d-flex align-items-center mb-4">

                        <div class="me-3">

                            <i class="bi bi-phone-fill fs-2 text-primary"></i>

                        </div>

                        <div>

                            <strong>
                                Vérification mobile
                            </strong>

                            <br>

                            <small class="text-muted">

                                Vérification par QR Code

                            </small>

                        </div>

                    </div>


                    {{-- DONNÉES --}}
                    <div class="d-flex align-items-center mb-4">

                        <div class="me-3">

                            <i class="bi bi-database-fill fs-2 text-warning"></i>

                        </div>

                        <div>

                            <strong>
                                Données centralisées
                            </strong>

                            <br>

                            <small class="text-muted">

                                Informations des membres UNEAC

                            </small>

                        </div>

                    </div>


                    {{-- CARTES --}}
                    <div class="d-flex align-items-center">

                        <div class="me-3">

                            <i class="bi bi-person-vcard-fill fs-2 text-success"></i>

                        </div>

                        <div>

                            <strong>
                                Cartes numériques
                            </strong>

                            <br>

                            <small class="text-muted">

                                Gestion et suivi des cartes

                            </small>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         RÉPARTITION CATÉGORIES + FÉDÉRATIONS
    ========================================================== --}}

    <div class="row">


        {{-- CATÉGORIES --}}
        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-1">

                        <i class="bi bi-bar-chart-fill text-success me-2"></i>

                        Membres par catégorie

                    </h5>

                    <p class="text-muted small mb-0">

                        Répartition des membres par domaine artistique.

                    </p>

                </div>


                <div class="card-body px-4">

                    @forelse($membersByCategory as $category)

                        <div class="mb-3">

                            <div class="d-flex justify-content-between mb-1">

                                <span class="small fw-semibold">

                                    {{ $category->nom }}

                                </span>

                                <span class="small text-muted">

                                    {{ $category->members_count }}

                                </span>

                            </div>


                            @php
                                $percentage = $totalMembers > 0
                                    ? ($category->members_count / $totalMembers) * 100
                                    : 0;
                            @endphp

                            <div class="progress"
                                 style="height: 7px;">

                                <div
                                    class="progress-bar bg-success"
                                    role="progressbar"
                                    style="width: {{ $percentage }}%"
                                ></div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-4 text-muted">

                            Aucune donnée disponible.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>



        {{-- FÉDÉRATIONS --}}
        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-1">

                        <i class="bi bi-diagram-3-fill text-primary me-2"></i>

                        Membres par fédération

                    </h5>

                    <p class="text-muted small mb-0">

                        Répartition des membres par fédération.

                    </p>

                </div>


                <div class="card-body px-4">

                    @forelse($membersByFederation as $federation)

                        <div class="mb-3">

                            <div class="d-flex justify-content-between mb-1">

                                <span class="small fw-semibold">

                                    {{ $federation->nom }}

                                </span>

                                <span class="small text-muted">

                                    {{ $federation->members_count }}

                                </span>

                            </div>


                            @php
                                $percentage = $totalMembers > 0
                                    ? ($federation->members_count / $totalMembers) * 100
                                    : 0;
                            @endphp


                            <div class="progress"
                                 style="height: 7px;">

                                <div
                                    class="progress-bar bg-primary"
                                    role="progressbar"
                                    style="width: {{ $percentage }}%"
                                ></div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-4 text-muted">

                            Aucune donnée disponible.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         CARTES RÉCENTES
    ========================================================== --}}

    <div class="row">

        <div class="col-12 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">

                                <i class="bi bi-person-vcard-fill text-success me-2"></i>

                                Dernières cartes

                            </h5>

                            <p class="text-muted small mb-0">

                                Les dernières cartes enregistrées dans le système.

                            </p>

                        </div>


                        <a href="{{ route('cards.index') }}"
                           class="btn btn-sm btn-outline-success">

                            Voir toutes les cartes

                        </a>

                    </div>

                </div>


                <div class="card-body px-4">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>
                                        Carte
                                    </th>

                                    <th>
                                        Membre
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

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($recentCards as $card)

                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $card->numero_carte }}
                                            </strong>

                                        </td>


                                        <td>

                                            @if($card->member)

                                                {{ $card->member->nom }}
                                                {{ $card->member->prenom }}

                                                <br>

                                                <small class="text-muted">

                                                    {{ $card->member->numero_membre }}

                                                </small>

                                            @else

                                                <span class="text-muted">
                                                    Membre supprimé
                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            {{ $card->date_delivrance
                                                ? $card->date_delivrance->format('d/m/Y')
                                                : '-' }}

                                        </td>


                                        <td>

                                            {{ $card->date_expiration
                                                ? $card->date_expiration->format('d/m/Y')
                                                : '-' }}

                                        </td>


                                        <td>

                                            @if($card->statut === 'active')

                                                <span class="badge bg-success">
                                                    Active
                                                </span>

                                            @elseif($card->statut === 'expiree')

                                                <span class="badge bg-warning text-dark">
                                                    Expirée
                                                </span>

                                            @elseif($card->statut === 'suspendue')

                                                <span class="badge bg-danger">
                                                    Suspendue
                                                </span>

                                            @else

                                                <span class="badge bg-secondary">
                                                    Révoquée
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="text-center text-muted py-4">

                                            <i class="bi bi-person-vcard fs-2 d-block mb-2"></i>

                                            Aucune carte enregistrée.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>

@stop
