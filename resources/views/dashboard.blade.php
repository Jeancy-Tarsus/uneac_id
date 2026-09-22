@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
        <div>
            <h1 class="dashboard-title mb-1">
                <i class="bi bi-grid-1x2-fill me-2"></i>
                Tableau de bord
            </h1>

            <p class="dashboard-subtitle mb-0">
                Vue d’ensemble de la gestion des membres et des cartes UNEAC ID.
            </p>
        </div>

        <div class="dashboard-date">
            <i class="bi bi-calendar3 me-2"></i>
            {{ now()->translatedFormat('l d F Y') }}
        </div>
    </div>
@stop


@section('content')

<style>

    :root {
        --uneac-green: #087f5b;
        --uneac-green-dark: #056044;
        --uneac-green-light: #e7f7f0;
        --uneac-blue: #2867c7;
        --uneac-orange: #c47b09;
        --uneac-purple: #7650c8;

        --text-dark: #1f2937;
        --text-muted: #6b7280;
        --border: #e8ecef;
        --page-bg: #f6f8f9;
    }

    .content-wrapper {
        background: var(--page-bg) !important;
    }


    /* =====================================================
       HEADER
    ===================================================== */

    .dashboard-title {
        font-size: 27px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .dashboard-subtitle {
        color: var(--text-muted);
        font-size: 14px;
    }

    .dashboard-date {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 10px 15px;
        color: #59636e;
        font-size: 13px;
        white-space: nowrap;
    }


    /* =====================================================
       STATISTIQUES
    ===================================================== */

    .dashboard-stat-link {
        display: block;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }

    .dashboard-stat-link:hover {
        color: inherit;
    }

    .stat-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 15px;
        min-height: 155px;
        height: 100%;
        padding: 21px;
        overflow: hidden;
        box-shadow: 0 3px 14px rgba(24,39,75,.045);
        transition: .18s ease;
    }

    .dashboard-stat-link:hover .stat-card {
        transform: translateY(-4px);
        border-color: rgba(8,127,91,.25);
        box-shadow: 0 10px 28px rgba(24,39,75,.10);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: -45px;
        top: -45px;
        border-radius: 50%;
        background: var(--stat-bg);
        opacity: .65;
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: var(--stat-bg);
        color: var(--stat-color);
        margin-bottom: 14px;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .stat-value {
        font-size: 29px;
        font-weight: 750;
        line-height: 1.2;
        color: var(--text-dark);
        margin: 4px 0 6px;
    }

    .stat-description {
        color: var(--text-muted);
        font-size: 12px;
        line-height: 1.4;
    }

    .stat-green {
        --stat-bg: #e7f7f0;
        --stat-color: #087f5b;
    }

    .stat-blue {
        --stat-bg: #eaf2ff;
        --stat-color: #2867c7;
    }

    .stat-orange {
        --stat-bg: #fff4df;
        --stat-color: #c47b09;
    }

    .stat-purple {
        --stat-bg: #f1ebff;
        --stat-color: #7650c8;
    }


    /* =====================================================
       CARTES GÉNÉRALES
    ===================================================== */

    .dashboard-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 15px;
        box-shadow: 0 3px 14px rgba(24,39,75,.045);
        height: 100%;
    }

    .dashboard-card-header {
        padding: 18px 20px 14px;
        border-bottom: 1px solid #eef1f3;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .dashboard-card-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .dashboard-card-subtitle {
        margin: 4px 0 0;
        font-size: 12px;
        color: var(--text-muted);
    }

    .dashboard-card-body {
        padding: 20px;
    }


    /* =====================================================
       PRODUCTION
    ===================================================== */

    .production-card {
        background: linear-gradient(
            135deg,
            #087f5b,
            #056044
        );

        color: #fff;
        border: none;
        overflow: hidden;
        position: relative;
    }

    .production-card::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        right: -100px;
        top: -120px;
        border: 35px solid rgba(255,255,255,.06);
        border-radius: 50%;
    }

    .production-content {
        position: relative;
        z-index: 2;
    }

    .production-title {
        font-size: 18px;
        font-weight: 700;
    }

    .production-description {
        font-size: 13px;
        opacity: .78;
        margin-top: 4px;
    }

    .production-box {
        display: block;
        text-decoration: none;
        color: #fff;

        background: rgba(255,255,255,.11);
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 12px;

        padding: 16px;

        transition: .18s ease;
    }

    .production-box:hover {
        color: #fff;
        background: rgba(255,255,255,.18);
        transform: translateY(-2px);
    }

    .production-label {
        font-size: 11px;
        text-transform: uppercase;
        opacity: .75;
    }

    .production-number {
        font-size: 27px;
        font-weight: 700;
        margin-top: 3px;
    }

    .production-progress {
        height: 8px;
        background: rgba(255,255,255,.15);
        border-radius: 20px;
        overflow: hidden;
    }

    .production-progress .progress-bar {
        background: #fff;
        border-radius: 20px;
    }


    /* =====================================================
       MEMBRES
    ===================================================== */

    .status-item {
        padding: 13px 0;
        border-bottom: 1px solid #eef1f3;
    }

    .status-item:first-child {
        padding-top: 0;
    }

    .status-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .status-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .status-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .status-number {
        font-size: 14px;
        font-weight: 700;
    }

    .status-bar {
        height: 6px;
        border-radius: 20px;
        background: #edf0f2;
        overflow: hidden;
        margin-top: 7px;
    }

    .status-bar span {
        display: block;
        height: 100%;
        border-radius: 20px;
    }


    /* =====================================================
       ACTIONS
    ===================================================== */

    .quick-action {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 14px;

        border: 1px solid var(--border);
        border-radius: 11px;

        background: #fff;

        text-decoration: none;
        color: var(--text-dark);

        transition: .18s ease;
    }

    .quick-action:hover {
        color: var(--uneac-green-dark);
        background: #f3fbf7;
        border-color: #c9ded7;
        transform: translateY(-2px);
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--uneac-green-light);
        color: var(--uneac-green);

        flex-shrink: 0;
    }

    .quick-action-title {
        font-size: 13px;
        font-weight: 700;
    }

    .quick-action-text {
        font-size: 11px;
        color: var(--text-muted);
    }


    /* =====================================================
       TABLEAUX
    ===================================================== */

    .dashboard-table {
        width: 100%;
        margin: 0;
        vertical-align: middle;
    }

    .dashboard-table th {
        border-top: 0;
        border-bottom: 1px solid #edf0f2;
        color: #78818b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .35px;
        font-weight: 700;
        padding: 12px 15px;
        white-space: nowrap;
    }

    .dashboard-table td {
        border-bottom: 1px solid #f0f2f4;
        padding: 13px 15px;
        font-size: 12px;
        color: #4b5563;
    }

    .dashboard-table tr:last-child td {
        border-bottom: 0;
    }

    .member-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--uneac-green-light);
        color: var(--uneac-green);

        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .member-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .member-number {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 2px;
    }


    /* =====================================================
       BADGES
    ===================================================== */

    .dashboard-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        border-radius: 20px;
        padding: 5px 9px;

        font-size: 10px;
        font-weight: 700;

        white-space: nowrap;
    }

    .badge-active {
        color: #087f5b;
        background: #e7f7f0;
    }

    .badge-pending {
        color: #a66a00;
        background: #fff4df;
    }

    .badge-produced {
        color: #2867c7;
        background: #eaf2ff;
    }

    .badge-suspended {
        color: #b42318;
        background: #fdecec;
    }

    .badge-inactive {
        color: #6b7280;
        background: #f0f1f3;
    }

    .badge-delivered {
        color: #087f5b;
        background: #e7f7f0;
    }


    /* =====================================================
       DISTRIBUTION
    ===================================================== */

    .distribution-item {
        margin-bottom: 18px;
    }

    .distribution-item:last-child {
        margin-bottom: 0;
    }

    .distribution-label {
        display: flex;
        justify-content: space-between;
        gap: 10px;

        font-size: 12px;
        margin-bottom: 7px;
    }

    .distribution-name {
        color: #4b5563;
        font-weight: 600;
    }

    .distribution-count {
        font-weight: 700;
        color: var(--text-dark);
    }

    .distribution-track {
        width: 100%;
        height: 7px;

        background: #edf1f2;
        border-radius: 20px;

        overflow: hidden;
    }

    .distribution-fill {
        height: 100%;
        border-radius: 20px;

        background: linear-gradient(
            90deg,
            #087f5b,
            #4caf86
        );
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-state {
        text-align: center;
        padding: 30px 15px;
        color: var(--text-muted);
    }

    .empty-state i {
        display: block;
        font-size: 30px;
        opacity: .45;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 12px;
        margin: 0;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 575.98px) {

        .dashboard-title {
            font-size: 23px;
        }

        .stat-card {
            min-height: 145px;
        }

        .dashboard-card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .dashboard-table {
            min-width: 620px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }

</style>


{{-- ==========================================================
     STATISTIQUES PRINCIPALES
========================================================== --}}

<div class="row g-3 mb-4">


    {{-- MEMBRES --}}

    <div class="col-12 col-sm-6 col-xl-3">

        <a
            href="{{ route('members.index') }}"
            class="dashboard-stat-link"
        >

            <div class="stat-card stat-green">

                <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="stat-label">
                    Membres
                </div>

                <div class="stat-value">
                    {{ number_format($totalMembers, 0, ',', ' ') }}
                </div>

                <div class="stat-description">
                    <i class="bi bi-person-plus me-1"></i>

                    {{ $newMembersThisMonth }}

                    nouveau{{ $newMembersThisMonth > 1 ? 'x' : '' }}

                    ce mois
                </div>

            </div>

        </a>

    </div>


    {{-- CARTES ACTIVES --}}

    <div class="col-12 col-sm-6 col-xl-3">

        <a
            href="{{ route('cards.index', ['statut' => 'active']) }}"
            class="dashboard-stat-link"
        >

            <div class="stat-card stat-blue">

                <div class="stat-icon">
                    <i class="bi bi-credit-card-2-front-fill"></i>
                </div>

                <div class="stat-label">
                    Cartes actives
                </div>

                <div class="stat-value">
                    {{ number_format($activeCards, 0, ',', ' ') }}
                </div>

                <div class="stat-description">
                    <i class="bi bi-shield-check me-1"></i>
                    Cartes actuellement valides
                </div>

            </div>

        </a>

    </div>


    {{-- À IMPRIMER
         Réservé au Super Admin
    --}}

    @if(auth()->user()->role === 'super_admin')

        <div class="col-12 col-sm-6 col-xl-3">

            <a
                href="{{ route('cards.index', [
                    'production' => 'en_attente'
                ]) }}"
                class="dashboard-stat-link"
            >

                <div class="stat-card stat-orange">

                    <div class="stat-icon">
                        <i class="bi bi-printer-fill"></i>
                    </div>

                    <div class="stat-label">
                        À imprimer
                    </div>

                    <div class="stat-value">
                        {{ number_format($cardsPendingProduction, 0, ',', ' ') }}
                    </div>

                    <div class="stat-description">
                        <i class="bi bi-hourglass-split me-1"></i>
                        Cartes en attente d'impression
                    </div>

                </div>

            </a>

        </div>

    @endif


    {{-- À REMETTRE À L'UNEAC
         Visible aux deux rôles
    --}}

    <div class="col-12 col-sm-6 col-xl-3">

        <a
            href="{{ route('cards.index', [
                'production' => 'produite',
                'remise_uneac' => '0'
            ]) }}"
            class="dashboard-stat-link"
        >

            <div class="stat-card stat-purple">

                <div class="stat-icon">
                    <i class="bi bi-building-check"></i>
                </div>

                <div class="stat-label">
                    À remettre à l'UNEAC
                </div>

                <div class="stat-value">

                    {{
                        number_format(
                            $cardsPendingUneacDelivery,
                            0,
                            ',',
                            ' '
                        )
                    }}

                </div>

                <div class="stat-description">
                    <i class="bi bi-box-seam me-1"></i>
                    Cartes produites à remettre
                </div>

            </div>

        </a>

    </div>

</div>


{{-- ==========================================================
     SUIVI PRODUCTION
========================================================== --}}

<div class="row g-3 mb-4">


    {{-- PRODUCTION --}}

    <div class="col-12 col-xl-8">

        <div class="dashboard-card production-card">

            <div class="dashboard-card-body production-content">

                <div class="d-flex justify-content-between gap-3 mb-4">

                    <div>

                        <div class="production-title">
                            <i class="bi bi-printer me-2"></i>
                            Suivi de production
                        </div>

                        <div class="production-description">
                            Suivi des cartes depuis l'impression jusqu'à leur remise.
                        </div>

                    </div>

                    <i
                        class="bi bi-credit-card-2-front"
                        style="font-size:34px;opacity:.7;"
                    ></i>

                </div>


                @php

                    /*
                    |--------------------------------------------------------------------------
                    | Les trois étapes du processus
                    |--------------------------------------------------------------------------
                    */

                    $cardsToUneac = \App\Models\Card::where(
                        'statut_production',
                        'produite'
                    )
                    ->where(
                        'remise_uneac',
                        false
                    )
                    ->count();


                    $cardsToArtist = \App\Models\Card::where(
                        'statut_production',
                        'produite'
                    )
                    ->where(
                        'remise_uneac',
                        true
                    )
                    ->where(
                        'remise_artiste',
                        false
                    )
                    ->count();


                    $totalProduction =
                        $cardsPendingProduction +
                        $cardsToUneac +
                        $cardsToArtist;


                    $produced =
                        $cardsToUneac +
                        $cardsToArtist;


                    $productionPercentage =
                        $totalProduction > 0
                            ? round(
                                ($produced / $totalProduction) * 100
                            )
                            : 0;

                @endphp


                <div class="row g-3">


                    {{-- À IMPRIMER
                         Super Admin uniquement
                    --}}

                    @if(auth()->user()->role === 'super_admin')

                        <div class="col-12 col-md-4">

                            <a
                                href="{{ route('cards.index', [
                                    'production' => 'en_attente'
                                ]) }}"
                                class="production-box"
                            >

                                <div class="production-label">
                                    À imprimer
                                </div>

                                <div class="production-number">
                                    {{ $cardsPendingProduction }}
                                </div>

                            </a>

                        </div>

                    @endif


                    {{-- À REMETTRE À UNEAC --}}

                    <div class="col-12 col-md-4">

                        <a
                            href="{{ route('cards.index', [
                                'production' => 'produite',
                                'remise_uneac' => '0'
                            ]) }}"
                            class="production-box"
                        >

                            <div class="production-label">
                                À remettre à l'UNEAC
                            </div>

                            <div class="production-number">
                                {{ $cardsPendingUneacDelivery }}
                            </div>

                        </a>

                    </div>


                    {{-- À REMETTRE À ARTISTE --}}

                    <div class="col-12 col-md-4">

                        <a
                            href="{{ route('cards.index', [
                                'production' => 'produite',
                                'remise_uneac' => '1',
                                'remise_artiste' => '0'
                            ]) }}"
                            class="production-box"
                        >

                            <div class="production-label">
                                À remettre à l'artiste
                            </div>

                            <div class="production-number">
                                {{ $cardsPendingArtistDelivery }}
                            </div>

                        </a>

                    </div>

                </div>


                <div class="d-flex justify-content-between mt-4 mb-2">

                    <span style="font-size:12px;opacity:.8;">
                        Progression de la production
                    </span>

                    <strong style="font-size:12px;">
                        {{ $productionPercentage }} %
                    </strong>

                </div>


                <div class="production-progress">

                    <div
                        class="progress-bar"
                        style="width:{{ $productionPercentage }}%;"
                    ></div>

                </div>

            </div>

        </div>

    </div>


    {{-- ÉTAT MEMBRES --}}

    <div class="col-12 col-xl-4">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div>

                    <h3 class="dashboard-card-title">
                        État des membres
                    </h3>

                    <p class="dashboard-card-subtitle">
                        Situation actuelle des membres.
                    </p>

                </div>

                <i class="bi bi-people text-success"></i>

            </div>


            <div class="dashboard-card-body">

                @php

                    $memberTotal = max($totalMembers, 1);

                    $activePercentage =
                        round(($activeMembers / $memberTotal) * 100);

                    $suspendedPercentage =
                        round(($suspendedMembers / $memberTotal) * 100);

                    $inactivePercentage =
                        round(($inactiveMembers / $memberTotal) * 100);

                @endphp


                {{-- ACTIFS --}}

                <div class="status-item">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="status-icon"
                            style="
                                background:#e7f7f0;
                                color:#087f5b;
                            "
                        >

                            <i class="bi bi-check-circle-fill"></i>

                        </div>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between">

                                <span class="status-label">
                                    Actifs
                                </span>

                                <span class="status-number">
                                    {{ $activeMembers }}
                                </span>

                            </div>

                            <div class="status-bar">

                                <span
                                    style="
                                        width:{{ $activePercentage }}%;
                                        background:#087f5b;
                                    "
                                ></span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SUSPENDUS --}}

                <div class="status-item">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="status-icon"
                            style="
                                background:#fdecec;
                                color:#b42318;
                            "
                        >

                            <i class="bi bi-pause-circle-fill"></i>

                        </div>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between">

                                <span class="status-label">
                                    Suspendus
                                </span>

                                <span class="status-number">
                                    {{ $suspendedMembers }}
                                </span>

                            </div>

                            <div class="status-bar">

                                <span
                                    style="
                                        width:{{ $suspendedPercentage }}%;
                                        background:#d92d20;
                                    "
                                ></span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- INACTIFS --}}

                <div class="status-item">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="status-icon"
                            style="
                                background:#f0f1f3;
                                color:#6b7280;
                            "
                        >

                            <i class="bi bi-person-x-fill"></i>

                        </div>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between">

                                <span class="status-label">
                                    Inactifs
                                </span>

                                <span class="status-number">
                                    {{ $inactiveMembers }}
                                </span>

                            </div>

                            <div class="status-bar">

                                <span
                                    style="
                                        width:{{ $inactivePercentage }}%;
                                        background:#6b7280;
                                    "
                                ></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ==========================================================
     ACTIONS RAPIDES
========================================================== --}}

<div class="dashboard-card mb-4">

    <div class="dashboard-card-header">

        <div>

            <h3 class="dashboard-card-title">
                Actions rapides
            </h3>

            <p class="dashboard-card-subtitle">
                Accès rapide aux principales fonctionnalités.
            </p>

        </div>

        <i class="bi bi-lightning-charge-fill text-warning"></i>

    </div>


    <div class="dashboard-card-body">

        <div class="row g-3">


            {{-- MEMBRES --}}

            <div class="col-12 col-md-6 col-xl-3">

                <a
                    href="{{ route('members.index') }}"
                    class="quick-action"
                >

                    <div class="quick-action-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div>

                        <div class="quick-action-title">
                            Membres
                        </div>

                        <div class="quick-action-text">
                            Gérer les membres
                        </div>

                    </div>

                </a>

            </div>


            {{-- CARTES --}}

            <div class="col-12 col-md-6 col-xl-3">

                <a
                    href="{{ route('cards.index') }}"
                    class="quick-action"
                >

                    <div class="quick-action-icon">
                        <i class="bi bi-credit-card-fill"></i>
                    </div>

                    <div>

                        <div class="quick-action-title">
                            Cartes
                        </div>

                        <div class="quick-action-text">
                            Gérer les cartes
                        </div>

                    </div>

                </a>

            </div>


            {{-- CATÉGORIES
                 Super Admin uniquement
            --}}

            @if(auth()->user()->role === 'super_admin')

                <div class="col-12 col-md-6 col-xl-3">

                    <a
                        href="{{ route('categories.index') }}"
                        class="quick-action"
                    >

                        <div class="quick-action-icon">
                            <i class="bi bi-tags-fill"></i>
                        </div>

                        <div>

                            <div class="quick-action-title">
                                Catégories
                            </div>

                            <div class="quick-action-text">
                                Gérer les catégories
                            </div>

                        </div>

                    </a>

                </div>


                {{-- FÉDÉRATIONS --}}

                <div class="col-12 col-md-6 col-xl-3">

                    <a
                        href="{{ route('federations.index') }}"
                        class="quick-action"
                    >

                        <div class="quick-action-icon">
                            <i class="bi bi-diagram-3-fill"></i>
                        </div>

                        <div>

                            <div class="quick-action-title">
                                Fédérations
                            </div>

                            <div class="quick-action-text">
                                Gérer les fédérations
                            </div>

                        </div>

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- ==========================================================
     DERNIERS MEMBRES / CARTES
========================================================== --}}

<div class="row g-3 mb-4">


    {{-- MEMBRES --}}

    <div class="col-12 col-xl-6">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div>

                    <h3 class="dashboard-card-title">
                        Derniers membres
                    </h3>

                    <p class="dashboard-card-subtitle">
                        Membres ajoutés récemment.
                    </p>

                </div>

                <a
                    href="{{ route('members.index') }}"
                    class="btn btn-sm btn-outline-success"
                >
                    Voir tout
                </a>

            </div>


            @if($recentMembers->count())

                <div class="table-responsive">

                    <table class="table dashboard-table">

                        <thead>

                            <tr>
                                <th>Membre</th>
                                <th>Catégorie</th>
                                <th>Statut</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($recentMembers as $member)

                                <tr>

                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="member-avatar">

                                                {{
                                                    strtoupper(
                                                        substr(
                                                            $member->prenom ?? '',
                                                            0,
                                                            1
                                                        )
                                                        .
                                                        substr(
                                                            $member->nom ?? '',
                                                            0,
                                                            1
                                                        )
                                                    )
                                                }}

                                            </div>

                                            <div>

                                                <div class="member-name">
                                                    {{ $member->prenom }}
                                                    {{ $member->nom }}
                                                </div>

                                                <div class="member-number">
                                                    {{ $member->numero_membre }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    <td>
                                        {{ $member->category->nom ?? '—' }}
                                    </td>


                                    <td>

                                        @if($member->statut === 'actif')

                                            <span class="dashboard-badge badge-active">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Actif
                                            </span>

                                        @elseif($member->statut === 'suspendu')

                                            <span class="dashboard-badge badge-suspended">
                                                <i class="bi bi-pause-circle-fill"></i>
                                                Suspendu
                                            </span>

                                        @else

                                            <span class="dashboard-badge badge-inactive">
                                                <i class="bi bi-dash-circle-fill"></i>
                                                Inactif
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <i class="bi bi-people"></i>

                    <p>
                        Aucun membre enregistré.
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- CARTES --}}

    <div class="col-12 col-xl-6">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div>

                    <h3 class="dashboard-card-title">
                        Dernières cartes
                    </h3>

                    <p class="dashboard-card-subtitle">
                        Cartes créées récemment.
                    </p>

                </div>

                <a
                    href="{{ route('cards.index') }}"
                    class="btn btn-sm btn-outline-success"
                >
                    Voir tout
                </a>

            </div>


            @if($recentCards->count())

                <div class="table-responsive">

                    <table class="table dashboard-table">

                        <thead>

                            <tr>
                                <th>Carte</th>
                                <th>Production</th>
                                <th>Remise</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($recentCards as $card)

                                <tr>

                                    <td>

                                        <div class="member-name">
                                            {{ $card->numero_carte }}
                                        </div>

                                        <div class="member-number">

                                            {{ $card->member->prenom ?? '' }}
                                            {{ $card->member->nom ?? '' }}

                                        </div>

                                    </td>


                                    <td>

                                        @if($card->statut_production === 'en_attente')

                                            <span class="dashboard-badge badge-pending">

                                                <i class="bi bi-hourglass-split"></i>

                                                À imprimer

                                            </span>

                                        @else

                                            <span class="dashboard-badge badge-produced">

                                                <i class="bi bi-printer-fill"></i>

                                                Produite

                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if(!$card->remise_uneac)

                                            <span class="dashboard-badge badge-pending">

                                                <i class="bi bi-building"></i>

                                                À remettre UNEAC

                                            </span>

                                        @elseif(!$card->remise_artiste)

                                            <span class="dashboard-badge badge-produced">

                                                <i class="bi bi-person"></i>

                                                À remettre artiste

                                            </span>

                                        @else

                                            <span class="dashboard-badge badge-delivered">

                                                <i class="bi bi-check-circle-fill"></i>

                                                Remise

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <i class="bi bi-credit-card"></i>

                    <p>
                        Aucune carte enregistrée.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- ==========================================================
     CATÉGORIES / FÉDÉRATIONS
========================================================== --}}

<div class="row g-3 mb-4">


    {{-- CATÉGORIES --}}

    <div class="col-12 col-xl-6">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div>

                    <h3 class="dashboard-card-title">
                        Membres par catégorie
                    </h3>

                    <p class="dashboard-card-subtitle">
                        Répartition selon le domaine artistique.
                    </p>

                </div>

                <i class="bi bi-pie-chart-fill text-success"></i>

            </div>


            <div class="dashboard-card-body">

                @php
                    $maxCategory =
                        $membersByCategory->max('members_count') ?: 1;
                @endphp


                @forelse($membersByCategory as $category)

                    <div class="distribution-item">

                        <div class="distribution-label">

                            <span class="distribution-name">
                                {{ $category->nom }}
                            </span>

                            <span class="distribution-count">
                                {{ $category->members_count }}
                            </span>

                        </div>


                        <div class="distribution-track">

                            <div
                                class="distribution-fill"
                                style="
                                    width:
                                    {{
                                        ($category->members_count /
                                        $maxCategory) * 100
                                    }}%;
                                "
                            ></div>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">

                        <i class="bi bi-bar-chart"></i>

                        <p>
                            Aucune donnée disponible.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- FÉDÉRATIONS --}}

    <div class="col-12 col-xl-6">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div>

                    <h3 class="dashboard-card-title">
                        Membres par fédération
                    </h3>

                    <p class="dashboard-card-subtitle">
                        Répartition des membres par fédération.
                    </p>

                </div>

                <i class="bi bi-diagram-3-fill text-success"></i>

            </div>


            <div class="dashboard-card-body">

                @php
                    $maxFederation =
                        $membersByFederation->max('members_count') ?: 1;
                @endphp


                @forelse($membersByFederation as $federation)

                    <div class="distribution-item">

                        <div class="distribution-label">

                            <span class="distribution-name">
                                {{ $federation->sigle ?? $federation->nom }}
                            </span>

                            <span class="distribution-count">
                                {{ $federation->members_count }}
                            </span>

                        </div>


                        <div class="distribution-track">

                            <div
                                class="distribution-fill"
                                style="
                                    width:
                                    {{
                                        ($federation->members_count /
                                        $maxFederation) * 100
                                    }}%;
                                "
                            ></div>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">

                        <i class="bi bi-bar-chart"></i>

                        <p>
                            Aucune donnée disponible.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>


{{-- ==========================================================
     ÉTAT GLOBAL DES CARTES
========================================================== --}}

<div class="dashboard-card mb-4">

    <div class="dashboard-card-header">

        <div>

            <h3 class="dashboard-card-title">
                État global des cartes
            </h3>

            <p class="dashboard-card-subtitle">
                Vue synthétique des cartes UNEAC.
            </p>

        </div>

        <i class="bi bi-credit-card-2-front-fill text-success"></i>

    </div>


    <div class="dashboard-card-body">

        <div class="row g-3">


            {{-- ACTIVES --}}

            <div class="col-6 col-md-3">

                <a
                    href="{{ route('cards.index', ['statut' => 'active']) }}"
                    style="text-decoration:none;"
                >

                    <div
                        class="text-center p-3 rounded"
                        style="background:#e7f7f0;"
                    >

                        <div
                            style="
                                font-size:24px;
                                font-weight:700;
                                color:#087f5b;
                            "
                        >
                            {{ $activeCards }}
                        </div>

                        <div style="font-size:12px;color:#5f6b75;">
                            Actives
                        </div>

                    </div>

                </a>

            </div>


            {{-- EXPIRÉES --}}

            <div class="col-6 col-md-3">

                <a
                    href="{{ route('cards.index', ['statut' => 'expiree']) }}"
                    style="text-decoration:none;"
                >

                    <div
                        class="text-center p-3 rounded"
                        style="background:#fff4df;"
                    >

                        <div
                            style="
                                font-size:24px;
                                font-weight:700;
                                color:#a66a00;
                            "
                        >
                            {{ $expiredCards }}
                        </div>

                        <div style="font-size:12px;color:#5f6b75;">
                            Expirées
                        </div>

                    </div>

                </a>

            </div>


            {{-- SUSPENDUES --}}

            <div class="col-6 col-md-3">

                <a
                    href="{{ route('cards.index', ['statut' => 'suspendue']) }}"
                    style="text-decoration:none;"
                >

                    <div
                        class="text-center p-3 rounded"
                        style="background:#fdecec;"
                    >

                        <div
                            style="
                                font-size:24px;
                                font-weight:700;
                                color:#b42318;
                            "
                        >
                            {{ $suspendedCards }}
                        </div>

                        <div style="font-size:12px;color:#5f6b75;">
                            Suspendues
                        </div>

                    </div>

                </a>

            </div>


            {{-- RÉVOQUÉES --}}

            <div class="col-6 col-md-3">

                <a
                    href="{{ route('cards.index', ['statut' => 'revoquee']) }}"
                    style="text-decoration:none;"
                >

                    <div
                        class="text-center p-3 rounded"
                        style="background:#f0f1f3;"
                    >

                        <div
                            style="
                                font-size:24px;
                                font-weight:700;
                                color:#6b7280;
                            "
                        >
                            {{ $revokedCards }}
                        </div>

                        <div style="font-size:12px;color:#5f6b75;">
                            Révoquées
                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>

</div>

@stop
