@extends('adminlte::page')

@section('title', 'Mon profil')

@section('content_header')
@stop

@section('content')

<div class="profile-page">

    {{-- =========================================================
         HERO PROFIL
    ========================================================== --}}
    <div class="profile-hero mb-4">

        <div class="profile-hero-pattern"></div>

        <div class="profile-hero-content">

            {{-- Avatar --}}
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            {{-- Informations --}}
            <div class="profile-main-info">

                <div class="profile-name-line">

                    <h2 class="profile-name">
                        {{ Auth::user()->name }}
                    </h2>

                    @if(Auth::user()->role === 'super_admin')

                        <span class="profile-role">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"></path>
                                <path d="M9 12l2 2 4-4"></path>
                            </svg>

                            Super Administrateur
                        </span>

                    @elseif(Auth::user()->role === 'admin_uneac')

                        <span class="profile-role">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                                <path d="M16 4l2 2 3-3"></path>
                            </svg>

                            Administrateur UNEAC
                        </span>

                    @else

                        <span class="profile-role">

                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                            </svg>

                            Utilisateur

                        </span>

                    @endif

                </div>


                <div class="profile-email">

                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M3 7l9 6 9-6"></path>
                    </svg>

                    {{ Auth::user()->email }}

                </div>

            </div>


            {{-- Statut --}}
            <div class="profile-status">

                <span class="status-dot"></span>

                <div>
                    <strong>Compte actif</strong>
                    <small>Accès sécurisé</small>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         NAVIGATION
    ========================================================== --}}
    <div class="profile-tabs mb-4">

        {{-- Profil --}}
        <div class="profile-tab active">

            <div class="tab-icon">

                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                </svg>

            </div>

            <div>
                <strong>Mon profil</strong>
                <small>Informations personnelles</small>
            </div>

        </div>


        {{-- Sécurité --}}
        <div class="profile-tab">

            <div class="tab-icon security">

                <svg viewBox="0 0 24 24">
                    <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                </svg>

            </div>

            <div>
                <strong>Sécurité</strong>
                <small>Mot de passe</small>
            </div>

        </div>


        {{-- Compte --}}
        <div class="profile-tab">

            <div class="tab-icon danger">

                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19 12a7 7 0 0 0-.1-1l2-1.5-2-3.5-2.3 1a7 7 0 0 0-1.7-1L14.6 3h-4l-.3 3a7 7 0 0 0-1.7 1l-2.3-1-2 3.5L6.3 11a7 7 0 0 0 0 2l-2 1.5 2 3.5 2.3-1a7 7 0 0 0 1.7 1l.3 3h4l.3-3a7 7 0 0 0 1.7-1l2.3 1 2-3.5-2-1.5c.1-.3.1-.7.1-1z"></path>
                </svg>

            </div>

            <div>
                <strong>Compte</strong>
                <small>Gestion du compte</small>
            </div>

        </div>

    </div>


    {{-- =========================================================
         CONTENU
    ========================================================== --}}
    <div class="row">

        {{-- =====================================================
             COLONNE PRINCIPALE
        ====================================================== --}}
        <div class="col-xl-8">


            {{-- =================================================
                 INFORMATIONS PERSONNELLES
            ================================================== --}}
            <div class="profile-panel mb-4">

                <div class="panel-header">

                    <div class="panel-heading">

                        <div class="panel-icon">

                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                                <path d="M16 4l2 2 3-3"></path>
                            </svg>

                        </div>

                        <div>

                            <h4>
                                Informations personnelles
                            </h4>

                            <p>
                                Modifiez les informations associées à votre compte.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="panel-body">

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>


            {{-- =================================================
                 MOT DE PASSE
            ================================================== --}}
            <div class="profile-panel mb-4">

                <div class="panel-header">

                    <div class="panel-heading">

                        <div class="panel-icon panel-blue">

                            <svg viewBox="0 0 24 24">
                                <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            </svg>

                        </div>

                        <div>

                            <h4>
                                Mot de passe
                            </h4>

                            <p>
                                Modifiez votre mot de passe pour sécuriser votre compte.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="panel-body">

                    @include('profile.partials.update-password-form')

                </div>

            </div>


            {{-- =================================================
                 SUPPRESSION DU COMPTE
            ================================================== --}}
            <div class="profile-panel danger-panel mb-4">

                <div class="panel-header">

                    <div class="panel-heading">

                        <div class="panel-icon panel-red">

                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                                <path d="M9 11l6 6"></path>
                                <path d="M15 11l-6 6"></path>
                            </svg>

                        </div>

                        <div>

                            <h4>
                                Suppression du compte
                            </h4>

                            <p>
                                Cette action est irréversible.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="panel-body">

                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>


        {{-- =====================================================
             COLONNE DROITE
        ====================================================== --}}
        <div class="col-xl-4">


            {{-- =================================================
                 INFORMATIONS COMPTE
            ================================================== --}}
            <div class="side-card mb-4">

                <div class="side-card-title">

                    <svg viewBox="0 0 24 24">
                        <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                        <circle cx="12" cy="9" r="3"></circle>
                        <path d="M8 17c1.2-2 6.8-2 8 0"></path>
                    </svg>

                    Informations du compte

                </div>


                <div class="account-info">

                    {{-- Nom --}}
                    <div class="account-row">

                        <div class="account-row-icon">

                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                            </svg>

                        </div>

                        <div>

                            <span>Nom</span>

                            <strong>
                                {{ Auth::user()->name }}
                            </strong>

                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="account-row">

                        <div class="account-row-icon">

                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <path d="M3 7l9 6 9-6"></path>
                            </svg>

                        </div>

                        <div>

                            <span>E-mail</span>

                            <strong class="text-break">
                                {{ Auth::user()->email }}
                            </strong>

                        </div>

                    </div>


                    {{-- Date --}}
                    <div class="account-row">

                        <div class="account-row-icon">

                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M3 10h18"></path>
                            </svg>

                        </div>

                        <div>

                            <span>Membre depuis</span>

                            <strong>
                                {{ Auth::user()->created_at?->format('d/m/Y') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 SÉCURITÉ
            ================================================== --}}
            <div class="security-box mb-4">

                <div class="security-box-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>

                </div>

                <div>

                    <h5>
                        Sécurité du compte
                    </h5>

                    <p>
                        Ne partagez jamais votre mot de passe.
                        Utilisez un mot de passe unique et difficile à deviner.
                    </p>

                </div>

            </div>


            {{-- =================================================
                 UNEAC
            ================================================== --}}
            <div class="uneac-mini-card">

                <div class="uneac-mini-logo">

                    <img
                        src="{{ asset('images/uneac-logo.png') }}"
                        alt="UNEAC"
                        onerror="this.style.display='none';"
                    >

                </div>

                <div>

                    <strong>
                        UNEAC ID
                    </strong>

                    <small>
                        Plateforme de gestion des membres
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
     STYLE
============================================================= --}}
<style>

/* =============================================================
   PAGE
============================================================= */

.profile-page {
    max-width: 1450px;
    margin: 0 auto;
    padding-bottom: 35px;
}


/* =============================================================
   HERO
============================================================= */

.profile-hero {
    position: relative;
    overflow: hidden;

    min-height: 185px;

    border-radius: 18px;

    background:
        linear-gradient(
            135deg,
            #087f3f 0%,
            #096f3b 55%,
            #064d2c 100%
        );

    color: #fff;

    box-shadow:
        0 12px 30px rgba(8,127,63,.18);
}

.profile-hero-pattern {
    position: absolute;

    width: 430px;
    height: 430px;

    right: -130px;
    top: -185px;

    border: 65px solid rgba(255,255,255,.05);

    border-radius: 50%;
}

.profile-hero-pattern::after {
    content: "";

    position: absolute;

    width: 270px;
    height: 270px;

    top: 15px;
    left: 10px;

    border: 2px solid rgba(255,255,255,.05);

    border-radius: 50%;
}

.profile-hero-content {
    position: relative;
    z-index: 2;

    min-height: 185px;

    padding: 30px 38px;

    display: flex;
    align-items: center;

    gap: 20px;
}


/* Avatar */

.profile-avatar {

    width: 96px;
    height: 96px;

    min-width: 96px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(255,255,255,.14);

    border: 3px solid rgba(255,255,255,.72);

    box-shadow:
        0 8px 25px rgba(0,0,0,.18);

    font-size: 38px;
    font-weight: 700;
}


/* Infos */

.profile-main-info {
    flex: 1;
}

.profile-name-line {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.profile-name {
    margin: 0;

    font-size: 27px;
    font-weight: 700;
}

.profile-role {

    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 11px;

    border-radius: 30px;

    background: rgba(255,255,255,.14);

    font-size: 11px;
    font-weight: 600;
}

.profile-role svg {

    width: 14px;
    height: 14px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.profile-email {

    display: flex;
    align-items: center;
    gap: 7px;

    margin-top: 10px;

    font-size: 14px;

    opacity: .85;
}

.profile-email svg {

    width: 15px;
    height: 15px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}


/* Statut */

.profile-status {

    display: flex;
    align-items: center;

    gap: 10px;

    padding: 11px 15px;

    background: rgba(255,255,255,.10);

    border-radius: 10px;
}

.profile-status strong,
.profile-status small {
    display: block;
}

.profile-status strong {
    font-size: 12px;
}

.profile-status small {
    font-size: 10px;
    opacity: .7;
}

.status-dot {

    width: 9px;
    height: 9px;

    border-radius: 50%;

    background: #55e58e;

    box-shadow:
        0 0 0 4px rgba(85,229,142,.14);
}


/* =============================================================
   TABS
============================================================= */

.profile-tabs {

    display: flex;
    gap: 8px;

    padding: 7px;

    background: var(--bs-body-bg);

    border: 1px solid var(--bs-border-color);

    border-radius: 13px;

    box-shadow:
        0 3px 12px rgba(0,0,0,.03);
}

.profile-tab {

    flex: 1;

    display: flex;
    align-items: center;

    gap: 10px;

    padding: 11px 14px;

    border-radius: 9px;

    color: var(--bs-secondary-color);
}

.profile-tab.active {

    background: rgba(8,127,63,.08);

    color: #087f3f;
}


/* Tab icon */

.tab-icon {

    width: 38px;
    height: 38px;

    min-width: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: rgba(8,127,63,.10);

    color: #087f3f;
}

.tab-icon.security {

    background: rgba(13,110,253,.10);

    color: #0d6efd;
}

.tab-icon.danger {

    background: rgba(220,53,69,.10);

    color: #dc3545;
}

.tab-icon svg {

    width: 19px;
    height: 19px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.profile-tab strong,
.profile-tab small {
    display: block;
}

.profile-tab strong {
    font-size: 13px;
}

.profile-tab small {

    margin-top: 2px;

    font-size: 10px;

    opacity: .7;
}


/* =============================================================
   PANELS
============================================================= */

.profile-panel {

    overflow: hidden;

    background: var(--bs-body-bg);

    border: 1px solid var(--bs-border-color);

    border-radius: 14px;

    box-shadow:
        0 3px 14px rgba(0,0,0,.025);
}

.panel-header {

    padding: 19px 23px;

    border-bottom: 1px solid var(--bs-border-color);
}

.panel-heading {

    display: flex;
    align-items: center;

    gap: 13px;
}

.panel-heading h4 {

    margin: 0;

    font-size: 16px;

    font-weight: 700;
}

.panel-heading p {

    margin: 4px 0 0;

    color: var(--bs-secondary-color);

    font-size: 12px;
}


/* Panel icons */

.panel-icon {

    width: 43px;
    height: 43px;

    min-width: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: rgba(8,127,63,.10);

    color: #087f3f;
}

.panel-blue {

    background: rgba(13,110,253,.10);

    color: #0d6efd;
}

.panel-red {

    background: rgba(220,53,69,.10);

    color: #dc3545;
}

.panel-icon svg {

    width: 20px;
    height: 20px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.panel-body {
    padding: 26px;
}

.danger-panel {
    border-color: rgba(220,53,69,.22);
}


/* =============================================================
   FORMULAIRES BREEZE
============================================================= */

.panel-body form {

    width: 100%;
}


/* Espacement des champs */

.panel-body form > div {

    margin-bottom: 19px;
}


/* Labels */

.panel-body form label {

    display: block;

    margin-bottom: 7px;

    color: var(--bs-body-color);

    font-size: 13px;

    font-weight: 600;
}


/* Inputs */

.panel-body form input[type="text"],
.panel-body form input[type="email"],
.panel-body form input[type="password"] {

    display: block;

    width: 100%;

    min-height: 44px;

    padding: 10px 13px;

    border: 1px solid var(--bs-border-color) !important;

    border-radius: 9px !important;

    background: var(--bs-body-bg) !important;

    color: var(--bs-body-color) !important;

    font-family: inherit;

    font-size: 14px;

    line-height: 1.5;

    outline: none;

    box-shadow: none !important;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}


/* Focus */

.panel-body form input[type="text"]:focus,
.panel-body form input[type="email"]:focus,
.panel-body form input[type="password"]:focus {

    border-color: #087f3f !important;

    box-shadow:
        0 0 0 3px rgba(8,127,63,.12) !important;
}


/* Placeholder */

.panel-body form input::placeholder {

    color: var(--bs-secondary-color);

    opacity: .65;
}


/* Boutons */

.panel-body form button[type="submit"] {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 40px;

    padding: 9px 20px;

    border: 0 !important;

    border-radius: 8px !important;

    background: #087f3f !important;

    color: #fff !important;

    font-size: 13px;

    font-weight: 600;

    box-shadow: none !important;

    transition: .2s ease;
}

.panel-body form button[type="submit"]:hover {

    background: #066b35 !important;

    transform: translateY(-1px);
}


/* Messages Breeze */

.panel-body form .text-gray-600,
.panel-body form .dark\:text-gray-400 {

    color: var(--bs-secondary-color) !important;
}


/* Erreurs */

.panel-body form [role="alert"] {

    margin-top: 6px;

    color: #dc3545;

    font-size: 12px;
}


/* =============================================================
   SIDE CARD
============================================================= */

.side-card {

    background: var(--bs-body-bg);

    border: 1px solid var(--bs-border-color);

    border-radius: 14px;

    overflow: hidden;
}

.side-card-title {

    display: flex;
    align-items: center;

    gap: 9px;

    padding: 17px 20px;

    border-bottom: 1px solid var(--bs-border-color);

    font-size: 14px;

    font-weight: 700;
}

.side-card-title svg {

    width: 18px;
    height: 18px;

    fill: none;

    stroke: #087f3f;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.account-info {
    padding: 7px 20px;
}

.account-row {

    display: flex;
    align-items: center;

    gap: 12px;

    padding: 15px 0;

    border-bottom: 1px solid var(--bs-border-color);
}

.account-row:last-child {
    border-bottom: 0;
}

.account-row-icon {

    width: 37px;
    height: 37px;

    min-width: 37px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: rgba(8,127,63,.09);

    color: #087f3f;
}

.account-row-icon svg {

    width: 17px;
    height: 17px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.account-row span,
.account-row strong {
    display: block;
}

.account-row span {

    margin-bottom: 2px;

    color: var(--bs-secondary-color);

    font-size: 10px;
}

.account-row strong {
    font-size: 12px;
}


/* =============================================================
   SECURITY BOX
============================================================= */

.security-box {

    display: flex;

    align-items: flex-start;

    gap: 13px;

    padding: 18px;

    border-radius: 13px;

    background: rgba(8,127,63,.06);

    border: 1px solid rgba(8,127,63,.12);
}

.security-box-icon {

    width: 41px;
    height: 41px;

    min-width: 41px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: rgba(8,127,63,.11);

    color: #087f3f;
}

.security-box-icon svg {

    width: 19px;
    height: 19px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.security-box h5 {

    margin: 0 0 5px;

    font-size: 13px;

    font-weight: 700;
}

.security-box p {

    margin: 0;

    color: var(--bs-secondary-color);

    font-size: 11px;

    line-height: 1.6;
}


/* =============================================================
   UNEAC MINI CARD
============================================================= */

.uneac-mini-card {

    display: flex;
    align-items: center;

    gap: 12px;

    padding: 15px 17px;

    border: 1px solid var(--bs-border-color);

    border-radius: 13px;

    background: var(--bs-body-bg);
}

.uneac-mini-logo {

    width: 43px;
    height: 43px;

    display: flex;
    align-items: center;
    justify-content: center;
}

.uneac-mini-logo img {

    max-width: 43px;
    max-height: 43px;

    object-fit: contain;
}

.uneac-mini-card strong,
.uneac-mini-card small {
    display: block;
}

.uneac-mini-card strong {
    font-size: 13px;
}

.uneac-mini-card small {

    margin-top: 3px;

    color: var(--bs-secondary-color);

    font-size: 10px;
}


/* =============================================================
   DARK MODE
============================================================= */

[data-bs-theme="dark"] .profile-tabs,
[data-bs-theme="dark"] .profile-panel,
[data-bs-theme="dark"] .side-card,
[data-bs-theme="dark"] .uneac-mini-card {

    box-shadow: none;
}

[data-bs-theme="dark"] .profile-tab.active {

    background: rgba(25,135,84,.14);

    color: #45c77d;
}

[data-bs-theme="dark"] .tab-icon {

    background: rgba(25,135,84,.13);

    color: #45c77d;
}

[data-bs-theme="dark"] .tab-icon.security {

    background: rgba(13,110,253,.14);

    color: #5b9cff;
}

[data-bs-theme="dark"] .tab-icon.danger {

    background: rgba(220,53,69,.14);

    color: #ff6876;
}

[data-bs-theme="dark"] .security-box {

    background: rgba(25,135,84,.09);

    border-color: rgba(25,135,84,.18);
}

[data-bs-theme="dark"] .panel-body form input[type="text"],
[data-bs-theme="dark"] .panel-body form input[type="email"],
[data-bs-theme="dark"] .panel-body form input[type="password"] {

    background: var(--bs-body-bg) !important;

    color: var(--bs-body-color) !important;

    border-color: var(--bs-border-color) !important;
}

[data-bs-theme="dark"] .panel-body form input[type="text"]:focus,
[data-bs-theme="dark"] .panel-body form input[type="email"]:focus,
[data-bs-theme="dark"] .panel-body form input[type="password"]:focus {

    border-color: #35ad69 !important;

    box-shadow:
        0 0 0 3px rgba(53,173,105,.15) !important;
}


/* =============================================================
   RESPONSIVE
============================================================= */

@media (max-width: 991px) {

    .profile-status {
        display: none;
    }

}

@media (max-width: 768px) {

    .profile-hero-content {

        flex-direction: column;

        align-items: flex-start;

        padding: 28px;
    }

    .profile-avatar {

        width: 78px;
        height: 78px;

        min-width: 78px;

        font-size: 30px;
    }

    .profile-name {
        font-size: 22px;
    }

    .profile-tabs {
        flex-direction: column;
    }

    .profile-tab {
        flex: none;
    }

    .panel-body {
        padding: 20px;
    }

}

</style>

@stop
