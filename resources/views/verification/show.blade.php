<!DOCTYPE html>

@php
    use Illuminate\Support\Facades\Storage;
@endphp
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Vérification UNEAC</title>


    {{-- =====================================================
         BOOTSTRAP
    ====================================================== --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">


    {{-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== --}}

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        /* =====================================================
           VARIABLES
        ====================================================== */

        :root {

            --uneac-green: #087f3f;

            --uneac-green-dark: #045c2d;

            --uneac-green-light: #eaf6ef;

            --uneac-gold: #c5a04a;

            --uneac-border: #e4ebe6;

            --text-dark: #202428;

            --text-muted: #737b80;

        }


        /* =====================================================
           BODY
        ====================================================== */

        body {

            margin: 0;

            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #f3f7f4 0%,
                    #ffffff 50%,
                    #edf6f0 100%
                );

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: var(--text-dark);

        }


        /* =====================================================
           WRAPPER
        ====================================================== */

        .verification-wrapper {

            min-height: 100vh;

            padding:
                35px 15px;

            display: flex;

            align-items: flex-start;

            justify-content: center;

        }


        /* =====================================================
           CARTE PRINCIPALE
        ====================================================== */

        .verification-card {

            width: 100%;

            max-width: 650px;

            background: #ffffff;

            border-radius: 22px;

            overflow: hidden;

            border: 1px solid #e2e7e4;

            box-shadow:
                0 15px 45px rgba(0, 0, 0, .09);

        }


        /* =====================================================
           HEADER
        ====================================================== */

        .verification-header {

            position: relative;

            min-height: 145px;

            background:
                linear-gradient(
                    135deg,
                    var(--uneac-green-dark) 0%,
                    var(--uneac-green) 55%,
                    #0a9149 100%
                );

            color: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            padding:
                25px 115px;

            overflow: hidden;

        }


        /* Décoration gauche */

        .verification-header::before {

            content: "";

            position: absolute;

            width: 190px;

            height: 190px;

            border:
                1px solid rgba(255,255,255,.12);

            border-radius: 50%;

            top: -100px;

            left: -70px;

        }


        /* Décoration droite */

        .verification-header::after {

            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            border:
                1px solid rgba(255,255,255,.10);

            border-radius: 50%;

            right: -80px;

            bottom: -145px;

        }


        /* =====================================================
           LOGO UNEAC
        ====================================================== */

        .header-logo {

            position: absolute;

            left: 25px;

            top: 50%;

            transform:
                translateY(-50%);

            width: 78px;

            height: 78px;

            background: #ffffff;

            border:
                3px solid var(--uneac-gold);

            border-radius: 50%;

            padding: 5px;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 5px 15px rgba(0,0,0,.20);

            z-index: 5;

        }


        .header-logo img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            border-radius: 50%;

        }


        /* =====================================================
           DRAPEAU
        ====================================================== */

        .header-flag {

            position: absolute;

            right: 25px;

            top: 50%;

            transform:
                translateY(-50%);

            width: 78px;

            height: 58px;

            background: rgba(255,255,255,.96);

            border-radius: 8px;

            padding: 5px;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 5px 15px rgba(0,0,0,.18);

            z-index: 5;

        }


        .header-flag img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            border-radius: 4px;

        }


        /* =====================================================
           CONTENU CENTRAL DU HEADER
        ====================================================== */

        .header-content {

            position: relative;

            z-index: 3;

            text-align: center;

            max-width: 400px;

        }


        .republic-title {

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1.5px;

            margin-bottom: 4px;

            opacity: .92;

        }


        .verification-header h1 {

            font-size: 25px;

            font-weight: 800;

            margin:
                0 0 5px;

            letter-spacing: .3px;

        }


        .verification-header p {

            font-size: 12px;

            opacity: .88;

            margin: 0;

        }


        /* =====================================================
           BODY
        ====================================================== */

        .verification-body {

            padding: 25px;

        }


        /* =====================================================
           STATUT
        ====================================================== */

        .status-box {

            border-radius: 16px;

            padding: 16px;

            text-align: center;

            margin-bottom: 25px;

            border:
                1px solid transparent;

        }


        .status-icon-wrapper {

            width: 42px;

            height: 42px;

            margin:
                0 auto 7px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            background:
                rgba(255,255,255,.75);

        }


        .status-title {

            font-size: 17px;

            font-weight: 900;

            letter-spacing: .7px;

        }


        .status-description {

            font-size: 12px;

            margin:
                4px 0 0;

        }


        /* =====================================================
           CARTE VALIDE
        ====================================================== */

        .status-active {

            background: #eaf7ef;

            border-color: #b9e3c8;

            color: #126b38;

        }


        .status-active
        .status-icon-wrapper {

            background: #198754;

            color: #ffffff;

        }


        /* =====================================================
           CARTE EXPIRÉE
        ====================================================== */

        .status-expired {

            background: #fff8e6;

            border-color: #f0d78d;

            color: #8a6500;

        }


        .status-expired
        .status-icon-wrapper {

            background: #ffc107;

            color: #ffffff;

        }


        /* =====================================================
           CARTE SUSPENDUE
        ====================================================== */

        .status-suspended {

            background: #f0f1f2;

            border-color: #d5d7da;

            color: #555b61;

        }


        .status-suspended
        .status-icon-wrapper {

            background: #6c757d;

            color: #ffffff;

        }


        /* =====================================================
           CARTE RÉVOQUÉE
        ====================================================== */

        .status-revoked {

            background: #fdecec;

            border-color: #f2bcbc;

            color: #a12828;

        }


        .status-revoked
        .status-icon-wrapper {

            background: #dc3545;

            color: #ffffff;

        }


        /* =====================================================
           PROFIL MEMBRE
        ====================================================== */

        .member-profile {

            text-align: center;

            margin-bottom: 25px;

        }


        .member-photo {

            width: 125px;

            height: 125px;

            object-fit: cover;

            border-radius: 50%;

            border:
                5px solid #ffffff;

            box-shadow:
                0 0 0 2px var(--uneac-green),
                0 6px 20px rgba(0,0,0,.15);

            margin-bottom: 13px;

        }


        .member-photo-placeholder {

            width: 125px;

            height: 125px;

            border-radius: 50%;

            background:
                var(--uneac-green-light);

            color:
                var(--uneac-green);

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border:
                2px solid #b9dfc8;

            margin-bottom: 13px;

        }


        .member-photo-placeholder i {

            font-size: 55px;

        }


        .member-name {

            font-size: 22px;

            font-weight: 800;

            color: #202020;

            margin-bottom: 4px;

            text-transform: uppercase;

            line-height: 1.2;

        }


        .member-profession {

            color:
                var(--text-muted);

            font-size: 14px;

            margin: 0;

        }


        /* =====================================================
           TITRE INFORMATIONS
        ====================================================== */

        .information-title {

            font-size: 15px;

            font-weight: 800;

            color:
                var(--uneac-green-dark);

            margin-bottom: 12px;

        }


        /* =====================================================
           BOÎTE INFORMATIONS
        ====================================================== */

        .information-box {

            background: #f8faf9;

            border:
                1px solid var(--uneac-border);

            border-radius: 15px;

            overflow: hidden;

        }


        .information-item {

            padding:
                13px 15px;

            border-bottom:
                1px solid #e7ece9;

        }


        .information-item:nth-child(odd) {

            border-right:
                1px solid #e7ece9;

        }


        .information-label {

            display: block;

            color:
                #7a8288;

            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: .4px;

            margin-bottom: 3px;

        }


        .information-value {

            display: block;

            color:
                #202428;

            font-size: 14px;

            font-weight: 700;

            overflow-wrap: anywhere;

            word-break: break-word;

        }


        /* =====================================================
           SÉCURITÉ
        ====================================================== */

        .security-box {

            margin-top: 22px;

            padding: 16px;

            background:
                var(--uneac-green-light);

            border:
                1px solid #cce6d5;

            border-radius: 14px;

            text-align: center;

        }


        .security-box > i {

            color:
                var(--uneac-green);

            font-size: 23px;

        }


        .security-title {

            color:
                var(--uneac-green-dark);

            font-size: 13px;

            font-weight: 800;

            margin-top: 5px;

            margin-bottom: 3px;

        }


        .security-text {

            color:
                #66716a;

            font-size: 11px;

            line-height: 1.5;

            margin: 0;

        }


        /* =====================================================
           FOOTER
        ====================================================== */

        .verification-footer {

            text-align: center;

            padding:
                18px 20px;

            border-top:
                1px solid #e9ecef;

            color:
                #8a9297;

            font-size: 10px;

        }


        .verification-footer strong {

            color:
                var(--uneac-green);

        }


        /* =====================================================
           RESPONSIVE MOBILE
        ====================================================== */

        @media (max-width: 576px) {

            .verification-wrapper {

                padding:
                    12px 8px;

            }


            .verification-card {

                border-radius: 17px;

            }


            .verification-header {

                min-height: 135px;

                padding:
                    22px 85px;

            }


            .header-logo {

                left: 12px;

                width: 62px;

                height: 62px;

            }


            .header-flag {

                right: 12px;

                width: 58px;

                height: 43px;

            }


            .republic-title {

                font-size: 9px;

                letter-spacing: 1px;

            }


            .verification-header h1 {

                font-size: 20px;

            }


            .verification-header p {

                font-size: 10px;

            }


            .verification-body {

                padding:
                    20px 15px;

            }


            .status-box {

                padding:
                    14px 10px;

            }


            .status-title {

                font-size: 16px;

            }


            .member-photo,
            .member-photo-placeholder {

                width: 110px;

                height: 110px;

            }


            .member-name {

                font-size: 18px;

            }


            .member-profession {

                font-size: 13px;

            }


            .information-item {

                padding:
                    11px 10px;

            }


            .information-label {

                font-size: 9px;

            }


            .information-value {

                font-size: 12px;

            }

        }


    </style>

</head>


<body>


<div class="verification-wrapper">


    <div class="verification-card">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="verification-header">


            {{-- LOGO UNEAC --}}

            <div class="header-logo">

                <img src="{{ asset('images/uneac-logo1.png') }}"
                     alt="Logo UNEAC">

            </div>


            {{-- DRAPEAU DU CONGO --}}

            <div class="header-flag">

                <img src="{{ asset('images/drapeau.png') }}"
                     alt="Drapeau de la République du Congo">

            </div>


            {{-- CONTENU CENTRAL --}}

            <div class="header-content">

                <div class="republic-title">
                    RÉPUBLIQUE DU CONGO
                </div>

                <h1>
                    Vérification UNEAC
                </h1>

                <p>
                    Vérification officielle de l'authenticité de la carte
                </p>

            </div>


        </div>


        {{-- =================================================
             BODY
        ================================================== --}}

        <div class="verification-body">


            {{-- =================================================
                 STATUT DE LA CARTE
            ================================================== --}}

            @if($card->statut === 'active')

                <div class="status-box status-active">

                    <div class="status-icon-wrapper">

                        <i class="bi bi-check-lg"></i>

                    </div>

                    <div class="status-title">
                        CARTE VALIDE
                    </div>

                    <p class="status-description">

                        Cette carte est actuellement valide
                        et reconnue par l'UNEAC.

                    </p>

                </div>


            @elseif($card->statut === 'expiree')

                <div class="status-box status-expired">

                    <div class="status-icon-wrapper">

                        <i class="bi bi-exclamation-lg"></i>

                    </div>

                    <div class="status-title">
                        CARTE EXPIRÉE
                    </div>

                    <p class="status-description">

                        La période de validité de cette carte
                        est arrivée à expiration.

                    </p>

                </div>


            @elseif($card->statut === 'suspendue')

                <div class="status-box status-suspended">

                    <div class="status-icon-wrapper">

                        <i class="bi bi-pause-fill"></i>

                    </div>

                    <div class="status-title">
                        CARTE SUSPENDUE
                    </div>

                    <p class="status-description">

                        Le statut de cette carte est
                        actuellement suspendu.

                    </p>

                </div>


            @else

                <div class="status-box status-revoked">

                    <div class="status-icon-wrapper">

                        <i class="bi bi-x-lg"></i>

                    </div>

                    <div class="status-title">
                        CARTE RÉVOQUÉE
                    </div>

                    <p class="status-description">

                        Cette carte n'est plus reconnue
                        comme valide par l'UNEAC.

                    </p>

                </div>

            @endif


            {{-- =================================================
                 PROFIL DU MEMBRE
            ================================================== --}}

            <div class="member-profile">


                @if($card->member->photo)

                    <img src="{{ app()->environment('production')
                         ? Storage::disk('uneac')->temporaryUrl(
                             $card->member->photo,
                             now()->addMinutes(30)
                         )
                         : asset('storage/' . $card->member->photo) }}"
                         alt="Photo du membre"
                         class="member-photo">

                @else

                    <div class="member-photo-placeholder">

                        <i class="bi bi-person-fill"></i>

                    </div>

                @endif


                <div class="member-name">

                    {{ $card->member->nom }}

                    {{ $card->member->postnom }}

                    {{ $card->member->prenom }}

                </div>


                <p class="member-profession">

                    {{ $card->member->profession_artistique
                        ?: 'Membre UNEAC' }}

                </p>


            </div>


            {{-- =================================================
                 INFORMATIONS DU TITULAIRE
            ================================================== --}}

            <div>


                <div class="information-title">

                    <i class="bi bi-person-vcard-fill me-1"></i>

                    Informations du titulaire

                </div>


                <div class="information-box">


                    <div class="row g-0">


                        {{-- NUMÉRO MEMBRE --}}

                        <div class="col-6 information-item">

                            <span class="information-label">
                                N° membre
                            </span>

                            <span class="information-value">

                                {{ $card->member->numero_membre }}

                            </span>

                        </div>


                        {{-- NUMÉRO CARTE --}}

                        <div class="col-6 information-item">

                            <span class="information-label">
                                N° carte
                            </span>

                            <span class="information-value">

                                {{ $card->numero_carte }}

                            </span>

                        </div>


                        {{-- CATÉGORIE --}}

                        <div class="col-6 information-item">

                            <span class="information-label">
                                Catégorie
                            </span>

                            <span class="information-value">

                                {{ $card->member->category->nom ?? '—' }}

                            </span>

                        </div>


                        {{-- FÉDÉRATION --}}

                        <div class="col-6 information-item">

                            <span class="information-label">
                                Fédération
                            </span>

                            <span class="information-value">

                                {{ $card->member->federation->sigle
                                    ?? $card->member->federation->nom
                                    ?? '—' }}

                            </span>

                        </div>


                        {{-- DATE DÉLIVRANCE --}}

                        <div class="col-6 information-item">

                            <span class="information-label">
                                Délivrée le
                            </span>

                            <span class="information-value">

                                {{ $card->date_delivrance?->format('d/m/Y')
                                    ?: '—' }}

                            </span>

                        </div>


                        {{-- DATE EXPIRATION --}}

                        <div class="col-6 information-item">

                            <span class="information-label">
                                Expire le
                            </span>

                            <span class="information-value">

                                {{ $card->date_expiration?->format('d/m/Y')
                                    ?: '—' }}

                            </span>

                        </div>


                    </div>

                </div>

            </div>


            {{-- =================================================
                 VÉRIFICATION SÉCURISÉE
            ================================================== --}}

            <div class="security-box">


                <i class="bi bi-shield-check"></i>


                <div class="security-title">

                    Vérification sécurisée

                </div>


                <p class="security-text">

                    Cette vérification a été effectuée à partir
                    du QR Code associé à la carte.

                    Les informations affichées proviennent
                    du système d'identification des membres
                    de l'UNEAC.

                </p>


            </div>


        </div>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="verification-footer">

            <strong>
                UNEAC ID
            </strong>

            — Plateforme d'identification
            des membres de l'UNEAC

            <br>

            <span>
                Document de vérification numérique
            </span>

        </div>


    </div>

</div>


</body>

</html>
