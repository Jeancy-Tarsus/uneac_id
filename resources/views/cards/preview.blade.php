@extends('adminlte::page')

@section('title', 'UNEAC ID - {{ $card->numero_carte }}')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between no-print">
        <div>
            <h1 class="m-0">
                <i class="bi bi-person-vcard-fill mr-2"></i>
                Aperçu de la carte
            </h1>
            <small class="text-muted">
                {{ $card->numero_carte }}
            </small>
        </div>
    </div>
@stop

@section('content')

    <div class="uneac-preview-adminlte">

<div class="page-container">


    {{-- =========================================================
         BOUTONS
    ========================================================== --}}

    <div class="actions no-print">

        <a
            href="{{ route('cards.index') }}"
            class="btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour aux cartes

        </a>


        <button
            type="button"
            id="btnEnregistrerImage"
            class="btn-primary"
            onclick="enregistrerCarteImage()"
        >

            <i class="bi bi-image me-1"></i>

            Enregistrer en image

        </button>


        <button
            type="button"
            class="btn-success"
            onclick="window.print()"
        >

            <i class="bi bi-printer me-1"></i>

            Imprimer la carte

        </button>

    </div>



    <div class="cards-container">


        {{-- =====================================================
             RECTO
        ====================================================== --}}

        <div class="print-card-wrapper recto-wrapper">

            <div
                class="uneac-card card-front"
                id="carte-recto"
            >


                {{-- FILIGRANES --}}

                <div class="cultural-watermark">

                    <div class="watermark-icon wm-book">
                        <i class="bi bi-book-half"></i>
                    </div>

                    <div class="watermark-icon wm-feather">
                        <i class="bi bi-feather"></i>
                    </div>

                    <div class="watermark-icon wm-music">
                        <i class="bi bi-music-note-beamed"></i>
                    </div>

                    <div class="watermark-icon wm-theatre">
                        <i class="bi bi-mask"></i>
                    </div>

                    <div class="watermark-icon wm-palette">
                        <i class="bi bi-palette"></i>
                    </div>

                    <div class="watermark-icon wm-camera">
                        <i class="bi bi-camera"></i>
                    </div>

                    <div class="watermark-circle"></div>

                    <div class="watermark-lines"></div>

                </div>


                {{-- DÉCORATIONS --}}

                <div class="shape shape-green-corner"></div>

                <div class="shape shape-gold-corner"></div>

                <div class="zigzag zigzag-top"></div>

                <div class="zigzag zigzag-bottom"></div>



                {{-- =================================================
                     HEADER RECTO
                ================================================== --}}

                <div class="front-header">


                    {{-- LOGO --}}

                    <div class="front-logo">

                        @if(file_exists(public_path('images/uneac-logo.png')))

                            <img
                                src="{{ asset('images/uneac-logo.png') }}"
                                alt="Logo UNEAC"
                            >

                        @else

                            <div class="logo-placeholder">
                                UNEAC
                            </div>

                        @endif

                    </div>


                    {{-- TEXTE --}}

                    <div class="front-header-text">

                        <div class="front-country">
                            RÉPUBLIQUE DU CONGO
                        </div>

                        <div class="front-organization">
                            UNION NATIONALE DES ÉCRIVAINS
                            ET ARTISTES CONGOLAIS
                        </div>

                        <div class="front-motto">
                            « UNITÉ • LIBERTÉ • CULTURE »
                        </div>

                    </div>


                    {{-- CARTE DU CONGO --}}

                    @if(file_exists(public_path('images/embleme-congo.png')))

                        <div class="front-emblem">

                            <img
                                src="{{ asset('images/embleme-congo.png') }}"
                                alt="Emblème du Congo"
                            >

                        </div>

                    @endif


                </div>


                {{-- =================================================
                     TITRE CARTE
                ================================================== --}}

                <div class="front-card-title">

                    <span>
                        CARTE DE MEMBRE
                    </span>

                </div>


                {{-- =================================================
                     CORPS RECTO
                ================================================== --}}

                <div class="front-body">


                    {{-- PHOTO --}}

                    @if($card->member->photo)

                        <img
                            src="{{ asset('storage/' . $card->member->photo) }}"
                            alt="Photo du membre"
                            class="member-photo"
                        >

                    @else

                        <div class="photo-placeholder">

                            <i class="bi bi-person-fill"></i>

                        </div>

                    @endif



                    {{-- INFORMATIONS --}}

                    <div class="member-info">


                        {{-- NOM --}}

                        <div class="info-row member-main-name">

                            <div class="info-label">
                                Nom(s)
                            </div>

                            <div class="info-value">

                                {{ $card->member->nom }}

                                @if($card->member->postnom)
                                    {{ $card->member->postnom }}
                                @endif

                            </div>

                        </div>


                        {{-- PRÉNOM --}}

                        <div class="info-row">

                            <div class="info-label">
                                Prénom(s)
                            </div>

                            <div class="info-value">

                                {{ $card->member->prenom }}

                            </div>

                        </div>


                        {{-- DATE NAISSANCE --}}

                        <div class="info-row">

                            <div class="info-label">
                                Date de naissance
                            </div>

                            <div class="info-value">

                                {{ $card->member->date_naissance?->format('d/m/Y') ?: 'Non renseignée' }}

                            </div>

                        </div>


                        {{-- SEXE --}}

                        <div class="info-row">

                            <div class="info-label">
                                Sexe
                            </div>

                            <div class="info-value">

                                {{ $card->member->sexe ?: 'Non renseigné' }}

                            </div>

                        </div>


                        {{-- LIEU --}}

                        <div class="info-row">

                            <div class="info-label">
                                Lieu
                            </div>

                            <div class="info-value">

                                {{ $card->member->lieu_naissance ?: 'Non renseigné' }}

                            </div>

                        </div>


                        {{-- NATIONALITÉ --}}

                        <div class="info-row">

                            <div class="info-label">
                                Nationalité
                            </div>

                            <div class="info-value">

                                {{ $card->member->nationalite ?: 'Non renseignée' }}

                            </div>

                        </div>


                        {{-- PROFESSION + FÉDÉRATION SUR LA MÊME LIGNE --}}

                        <div class="info-dual-row">

                            <div class="info-pair">

                                <div class="info-label">
                                    Profession
                                </div>

                                <div class="info-value">

                                    {{ $card->member->profession_artistique ?: 'Non renseignée' }}

                                </div>

                            </div>


                            <div class="info-pair">

                                <div class="info-label">
                                    Fédération
                                </div>

                                <div class="info-value">

                                    {{
                                        $card->member->federation?->sigle
                                        ?: $card->member->federation?->nom
                                        ?: 'Non renseignée'
                                    }}

                                </div>

                            </div>

                        </div>


                        {{-- DOMICILE --}}

                        <div class="info-row">

                            <div class="info-label">
                                Domicile
                            </div>

                            <div class="info-value">

                                {{ $card->member->domicile ?: 'Non renseigné' }}

                            </div>

                        </div>


                    </div>


                    {{-- NUMÉRO DE CARTE --}}

                    <div class="front-card-number">

                        {{ $card->numero_carte }}

                    </div>


                </div>


                {{-- FOOTER --}}

                <div class="front-footer"></div>


            </div>

        </div>



        {{-- =====================================================
             VERSO
        ====================================================== --}}

        <div class="print-card-wrapper verso-wrapper">

            <div
                class="uneac-card card-back"
                id="carte-verso"
            >


                {{-- FILIGRANES CULTURELS --}}

                <div class="cultural-watermark">

                    <div class="watermark-icon wm-book">
                        <i class="bi bi-book-half"></i>
                    </div>

                    <div class="watermark-icon wm-feather">
                        <i class="bi bi-feather"></i>
                    </div>

                    <div class="watermark-icon wm-music">
                        <i class="bi bi-music-note-beamed"></i>
                    </div>

                    <div class="watermark-icon wm-theatre">
                        <i class="bi bi-mask"></i>
                    </div>

                    <div class="watermark-icon wm-palette">
                        <i class="bi bi-palette"></i>
                    </div>

                    <div class="watermark-icon wm-camera">
                        <i class="bi bi-camera"></i>
                    </div>

                    <div class="watermark-circle"></div>

                    <div class="watermark-lines"></div>

                </div>


                {{-- FILIGRANE CENTRAL — EMBLÈME DU CONGO --}}

                @if(file_exists(public_path('images/embleme-congo.png')))

                    <div class="back-watermark-emblem">

                        <img
                            src="{{ asset('images/embleme-congo.png') }}"
                            alt=""
                        >

                    </div>

                @endif


                <div class="back-cultural-watermarks">

                    <i class="bi bi-book-half back-wm-book"></i>

                    <i class="bi bi-feather back-wm-feather"></i>

                    <i class="bi bi-music-note-beamed back-wm-music"></i>

                    <i class="bi bi-camera back-wm-camera"></i>

                </div>


                {{-- DÉCORATIONS --}}

                <div class="shape shape-green-corner"></div>

                <div class="shape shape-gold-corner"></div>

                <div class="zigzag zigzag-top"></div>

                <div class="zigzag zigzag-bottom"></div>



                {{-- =================================================
                     HEADER VERSO
                ================================================== --}}

                <div class="back-header">


                    {{-- LOGO --}}

                    <div class="back-logo">

                        @if(file_exists(public_path('images/uneac-logo.png')))

                            <img
                                src="{{ asset('images/uneac-logo.png') }}"
                                alt="Logo UNEAC"
                            >

                        @else

                            <div class="logo-placeholder">
                                UNEAC
                            </div>

                        @endif

                    </div>


                    {{-- TEXTE --}}

                    <div class="back-header-text">

                        <div class="back-country">
                            RÉPUBLIQUE DU CONGO
                        </div>

                        <div class="back-motto">
                            « UNITÉ • LIBERTÉ • CULTURE »
                        </div>

                        <div class="back-gold-line"></div>

                    </div>


                    {{-- EMBLÈME DU CONGO --}}

                    @if(file_exists(public_path('images/embleme-congo.png')))

                        <div class="back-congo">

                            <img
                                src="{{ asset('images/embleme-congo.png') }}"
                                alt="Emblème du Congo"
                            >

                        </div>

                    @endif


                </div>



                {{-- =================================================
                     TEXTES DÉCORATIFS
                ================================================== --}}

                <div class="decorative-left">

                    UNION • CULTURE • ART

                </div>


                <div class="decorative-right">

                    UNEAC • CONGO

                </div>



                {{-- =================================================
                     CONTENU PRINCIPAL VERSO
                ================================================== --}}

                <div class="back-main">


                    {{-- TITRE --}}

                    <div class="security-title">

                        <i class="bi bi-shield-check"></i>

                        Carte officielle de membre

                    </div>


                    {{-- DESCRIPTION --}}

                    <p class="security-description">

                        Cette carte est personnelle et permet
                        d'identifier son titulaire en qualité de
                        membre de l'UNEAC.
                        <br>

                        Son authenticité et son statut peuvent être
                        vérifiés à l'aide du QR Code.

                    </p>


                    {{-- =================================================
                         QR CODE CENTRE
                    ================================================== --}}

                    <div class="back-qr">

                        <div class="back-qr-box">

                            {!! QrCode::size(130)
                                ->generate(
                                    route(
                                        'verification.show',
                                        $card->qr_token
                                    )
                                )
                            !!}

                        </div>


                        <div class="back-qr-label">

                            Scanner pour vérifier l'authenticité

                        </div>

                    </div>


                </div>



                {{-- =================================================
                     DATES + SIGNATURE
                ================================================== --}}

                <div class="back-bottom">


                    {{-- DATES --}}

                    <div class="dates">


                        <div class="date-box">

                            <div class="date-label">
                                Délivrée le
                            </div>

                            <div class="date-value">

                                {{ $card->date_delivrance?->format('d/m/Y') }}

                            </div>

                        </div>


                        <div class="date-box">

                            <div class="date-label">
                                Expire le
                            </div>

                            <div class="date-value">

                                {{ $card->date_expiration?->format('d/m/Y') }}

                            </div>

                        </div>


                    </div>



                    {{-- PRÉSIDENT --}}

                    <div class="president">

                        <div class="president-label">

                            Le Président

                        </div>


                        @if(file_exists(public_path('images/signature-president.png')))

                            <img
                                src="{{ asset('images/signature-president.png') }}"
                                alt="Signature du Président"
                                class="president-signature-image"
                            >

                        @else

                            <div class="signature-line"></div>

                        @endif


                        <div class="president-name">

                            {{ $presidentName ?? 'Henri DJOMBO' }}

                        </div>


                        <div class="president-name president-role">

                            Signature et cachet de l'UNEAC

                        </div>

                    </div>


                </div>



                {{-- =================================================
                     TEXTE BAS
                ================================================== --}}

                <div class="back-bottom-text">

                    <span>
                        UNION NATIONALE DES ÉCRIVAINS ET ARTISTES CONGOLAIS
                    </span>

                    &nbsp; • &nbsp;

                    CARTE OFFICIELLE

                </div>



                {{-- FOOTER --}}

                <div class="back-footer"></div>


            </div>

        </div>


    </div>

</div>



{{-- =============================================================
     HTML2CANVAS
============================================================= --}}






    </div>

@stop

@section('css')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>


        /* =========================================================
           VARIABLES UNEAC
        ========================================================== */

        :root {

            --uneac-green: #087f3f;
            --uneac-green-dark: #045c2d;
            --uneac-green-deep: #023b1d;
            --uneac-green-light: #eaf6ef;

            --uneac-gold: #c5a04a;
            --uneac-gold-light: #e2cc8b;

            --uneac-gray: #66706a;
            --uneac-border: #d9e2dc;

            --text-dark: #202622;
            --text-gray: #626a65;

        }


        /* =========================================================
           RESET
        ========================================================== */

        * {
            box-sizing: border-box;
        }


        html,
        body {

            margin: 0;
            padding: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #eef1ef;

            color: var(--text-dark);

        }


        body {
            min-height: 100vh;
        }


        /* =========================================================
           CONTENEUR PRINCIPAL
        ========================================================== */

        .page-container {

            width: 100%;
            min-height: 100vh;

            padding: 35px;

        }


        /* =========================================================
           BOUTONS
        ========================================================== */

        .actions {

            display: flex;

            justify-content: center;
            align-items: center;

            gap: 10px;

            flex-wrap: wrap;

            margin-bottom: 30px;

        }


        .actions button,
        .actions a {

            border: none;

            border-radius: 7px;

            padding: 10px 18px;

            font-size: 14px;

            font-weight: 700;

            text-decoration: none;

            cursor: pointer;

        }


        .actions .btn-secondary {

            background: #6c757d;
            color: white;

        }


        .actions .btn-primary {

            background: var(--uneac-green);
            color: white;

        }


        .actions .btn-success {

            background: var(--uneac-green-dark);
            color: white;

        }


        .actions button:hover,
        .actions a:hover {

            opacity: .90;

        }


        /* =========================================================
           CONTENEUR DES CARTES
        ========================================================== */

        .cards-container {

            display: flex;

            flex-direction: column;

            align-items: center;

            gap: 45px;

        }


        /* =========================================================
           WRAPPER
        ========================================================== */

        .print-card-wrapper {

            width: 850px;
            height: 536px;

            position: relative;

        }


        /* =========================================================
           CARTE PRINCIPALE
        ========================================================== */

        .uneac-card {

            width: 850px;
            height: 536px;

            position: relative;

            overflow: hidden;

            background: #ffffff;

            border: 3px solid var(--uneac-green);

            border-radius: 22px;

            box-shadow:
                0 18px 45px rgba(0,0,0,.16);

            isolation: isolate;

        }


        /* =========================================================
           BORDURE INTERNE DORÉE
        ========================================================== */

        .uneac-card::after {

            content: "";

            position: absolute;

            inset: 8px;

            border:
                1px solid rgba(197,160,74,.75);

            border-radius: 16px;

            pointer-events: none;

            z-index: 50;

        }


        /* =========================================================
           FILIGRANES CULTURELS
        ========================================================== */

        .cultural-watermark {

            position: absolute;

            inset: 0;

            overflow: hidden;

            pointer-events: none;

            z-index: 1;

        }


        .watermark-icon {

            position: absolute;

            color: var(--uneac-green);

            opacity: .055;

            font-size: 105px;

        }


        .wm-book {

            left: 80px;
            bottom: 35px;

            transform: rotate(-15deg);

        }


        .wm-feather {

            left: 320px;
            top: 155px;

            transform: rotate(-25deg);

        }


        .wm-music {

            right: 250px;
            bottom: 65px;

            transform: rotate(12deg);

        }


        .wm-theatre {

            right: 70px;
            top: 160px;

            transform: rotate(12deg);

        }


        .wm-palette {

            left: 245px;
            bottom: 10px;

            transform: rotate(-8deg);

        }


        .wm-camera {

            right: 95px;
            bottom: 35px;

            transform: rotate(-10deg);

        }


        .watermark-circle {

            position: absolute;

            width: 380px;
            height: 380px;

            border:
                35px solid var(--uneac-green);

            border-radius: 50%;

            right: -170px;
            top: 120px;

            opacity: .035;

        }


        .watermark-lines {

            position: absolute;

            width: 650px;
            height: 250px;

            right: -130px;
            bottom: -80px;

            transform: rotate(-20deg);

            opacity: .035;

            background:
                repeating-linear-gradient(
                    135deg,
                    var(--uneac-green) 0,
                    var(--uneac-green) 3px,
                    transparent 3px,
                    transparent 20px
                );

        }


        /* =========================================================
           FORMES DÉCORATIVES
        ========================================================== */

        .shape {

            position: absolute;

            pointer-events: none;

            z-index: 3;

        }


        .shape-green-corner {

            width: 175px;
            height: 175px;

            left: -115px;
            top: -115px;

            background:
                var(--uneac-green);

            transform: rotate(45deg);

            opacity: .95;

        }


        .shape-gold-corner {

            width: 125px;
            height: 125px;

            right: -80px;
            bottom: -80px;

            background:
                var(--uneac-gold);

            transform: rotate(45deg);

            opacity: .95;

        }


        /* =========================================================
           ZIGZAG
        ========================================================== */

        .zigzag {

            position: absolute;

            height: 16px;
            width: 220px;

            z-index: 5;

            opacity: .85;

            background:
                linear-gradient(
                    135deg,
                    transparent 7px,
                    var(--uneac-gold) 7px,
                    var(--uneac-gold) 10px,
                    transparent 10px
                );

            background-size: 20px 20px;

        }


        .zigzag-top {

            right: 0;
            top: 105px;

            transform: rotate(180deg);

        }


        .zigzag-bottom {

            left: 0;
            bottom: 20px;

        }


        /* =========================================================
           =========================================================
           RECTO
           =========================================================
        ========================================================== */

        .card-front {

            background: #ffffff;

        }


        /* =========================================================
           HEADER RECTO
        ========================================================== */

        .front-header {

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 170px;

            z-index: 10;

            text-align: center;

        }


        /* =========================================================
           LOGO RECTO
        ========================================================== */

        .front-logo {

            position: absolute;

            left: 58px;
            top: 42px;

            width: 105px;
            height: 105px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: white;

            border: 3px solid white;

            border-radius: 50%;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 6px 18px rgba(0,0,0,.15);

            overflow: hidden;

            z-index: 20;

        }


        .front-logo img {

            width: 86px;
            height: 86px;

            max-width: 86px;
            max-height: 86px;

            object-fit: contain;

            display: block;

        }


        .logo-placeholder {

            color: var(--uneac-green);

            font-size: 15px;

            font-weight: 900;

        }


        /* =========================================================
           TEXTE RECTO
        ========================================================== */

        .front-header-text {

            position: absolute;

            left: 190px;
            right: 190px;

            top: 25px;

            text-align: center;

            z-index: 20;

        }


        .front-country {

            font-size: 28px;

            line-height: 1;

            font-weight: 900;

            letter-spacing: 2px;

            color: var(--uneac-green-dark);

            margin-bottom: 10px;

        }


        .front-organization {

            font-size: 18px;

            line-height: 1.25;

            font-weight: 900;

            text-transform: uppercase;

            color: var(--text-dark);

            letter-spacing: .8px;

        }


        .front-motto {

            margin-top: 8px;

            font-size: 13px;

            font-weight: 900;

            letter-spacing: 2.5px;

            text-transform: uppercase;

            color: var(--uneac-green);

        }


        /* =========================================================
           EMBLÈME DU CONGO RECTO
        ========================================================== */

        .front-emblem {

            position: absolute;

            right: 38px;
            top: 38px;

            width: 82px;
            height: 100px;

            z-index: 20;

            display: flex;

            justify-content: center;
            align-items: center;

            background: rgba(255,255,255,.96);

            border-radius: 8px;

            padding: 4px;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 4px 12px rgba(0,0,0,.10);

        }


        .front-emblem img {

            width: 100%;
            height: 100%;

            object-fit: contain;

            opacity: 1;

            filter: none;

            display: block;

        }


        /* =========================================================
           TITRE CARTE DE MEMBRE
        ========================================================== */

        .front-card-title {

            position: absolute;

            top: 145px;

            left: 70px;
            right: 70px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 15px;

            z-index: 20;

        }


        .front-card-title::before,
        .front-card-title::after {

            content: "";

            height: 2px;

            flex: 1;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    var(--uneac-gold)
                );

        }


        .front-card-title::after {

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-gold),
                    transparent
                );

        }


        .front-card-title span {

            font-size: 18px;

            font-weight: 900;

            letter-spacing: 2px;

            color: var(--uneac-green-dark);

            white-space: nowrap;

        }


        /* =========================================================
           CORPS RECTO
        ========================================================== */

        .front-body {

            position: absolute;

            left: 0;
            right: 0;

            top: 180px;
            bottom: 45px;

            z-index: 10;

        }


        /* =========================================================
           PHOTO
        ========================================================== */

        .member-photo,
        .photo-placeholder {

            position: absolute;

            left: 75px;
            top: 5px;

            width: 190px;
            height: 245px;

            object-fit: cover;

            border: 4px solid white;

            outline:
                3px solid var(--uneac-green);

            border-radius: 10px;

            background: #f2f5f3;

            box-shadow:
                0 7px 20px rgba(0,0,0,.15);

            z-index: 15;

        }


        .photo-placeholder {

            display: flex;

            align-items: center;
            justify-content: center;

            color: #9ba59f;

            font-size: 65px;

        }


        /* =========================================================
           INFORMATIONS MEMBRE
        ========================================================== */

        .member-info {

            position: absolute;

            left: 300px;
            right: 55px;

            top: 0;

            z-index: 20;

        }


        .info-row {

            display: flex;

            align-items: baseline;

            margin-bottom: 8px;

            border-bottom:
                1px solid rgba(8,127,63,.13);

            padding-bottom: 5px;

        }


        .info-label {

            width: 155px;

            flex-shrink: 0;

            font-size: 12px;

            font-weight: 900;

            text-transform: uppercase;

            letter-spacing: .8px;

            color: var(--uneac-green);

        }


        .info-value {

            flex: 1;

            min-width: 0;

            font-size: 17px;

            line-height: 1.15;

            font-weight: 700;

            color: #252b28;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           NOM PRINCIPAL
        ========================================================== */

        .member-main-name {

            margin-bottom: 10px;

        }


        .member-main-name .info-label {

            font-size: 13px;

        }


        .member-main-name .info-value {

            font-size: 23px;

            font-weight: 900;

            text-transform: uppercase;

            color: var(--uneac-green-dark);

        }


        /* =========================================================
           NUMÉRO CARTE RECTO
        ========================================================== */

        .front-card-number {

            position: absolute;

            left: 75px;

            width: 190px;

            bottom: 0;

            z-index: 30;

            padding: 7px 10px;

            text-align: center;

            background: var(--uneac-green);

            color: white;

            border-radius: 5px;

            font-size: 17px;

            font-weight: 900;

            letter-spacing: 1.4px;

            box-shadow: 0 4px 12px rgba(8,127,63,.20);

        }

        /* Profession + Fédération sur la même ligne */
        .info-dual-row {

            display: flex;

            gap: 14px;

            align-items: flex-start;

            border-bottom: 1px solid rgba(8,127,63,.13);

            padding-bottom: 5px;

            margin-bottom: 8px;

        }

        .info-pair {

            flex: 1;

            min-width: 0;

            display: flex;

            align-items: baseline;

            gap: 8px;

        }

        .info-pair .info-label {

            width: auto;

            flex-shrink: 0;

            font-size: 11px;

        }

        .info-pair .info-value {

            font-size: 15px;

        }


        /* =========================================================
           FOOTER RECTO
        ========================================================== */

        .front-footer {

            position: absolute;

            left: 0;
            right: 0;
            bottom: 0;

            height: 9px;

            z-index: 40;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-green-deep) 0%,
                    var(--uneac-green) 72%,
                    var(--uneac-gold) 72%,
                    var(--uneac-gold) 100%
                );

        }


        /* =========================================================
           =========================================================
           VERSO
           =========================================================
        ========================================================== */

        .card-back {

            background: #ffffff;

        }


        /* =========================================================
           HEADER VERSO
        ========================================================== */

        .back-header {

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 155px;

            z-index: 10;

            text-align: center;

        }


        /* =========================================================
           LOGO VERSO
        ========================================================== */

        .back-logo {

            position: absolute;

            left: 58px;
            top: 35px;

            width: 95px;
            height: 95px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: white;

            border: 3px solid white;

            border-radius: 50%;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 5px 16px rgba(0,0,0,.14);

            overflow: hidden;

            z-index: 20;

        }


        .back-logo img {

            width: 76px;
            height: 76px;

            max-width: 76px;
            max-height: 76px;

            object-fit: contain;

        }


        /* =========================================================
           TEXTE VERSO
        ========================================================== */

        .back-header-text {

            position: absolute;

            left: 180px;
            right: 180px;

            top: 35px;

            z-index: 20;

        }


        .back-country {

            font-size: 28px;

            font-weight: 900;

            letter-spacing: 2.5px;

            color: var(--uneac-green-dark);

        }


        .back-motto {

            margin-top: 10px;

            font-size: 14px;

            font-weight: 900;

            letter-spacing: 3px;

            color: var(--uneac-green);

            text-transform: uppercase;

        }


        .back-gold-line {

            width: 430px;

            height: 3px;

            margin: 16px auto 0;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    var(--uneac-gold),
                    transparent
                );

        }


        /* =========================================================
           TEXTES DÉCORATIFS GAUCHE / DROITE
        ========================================================== */

        .decorative-left,
        .decorative-right {

            position: absolute;

            top: 150px;

            z-index: 12;

            writing-mode: vertical-rl;

            text-orientation: mixed;

            font-size: 10px;

            font-weight: 900;

            letter-spacing: 2px;

            color:
                rgba(8,127,63,.45);

            text-transform: uppercase;

        }


        .decorative-left {

            left: 25px;

            transform:
                rotate(180deg);

        }


        .decorative-right {

            right: 25px;

        }


        /* =========================================================
           FILIGRANE EMBLÈME DU CONGO VERSO
        ========================================================== */

        .back-congo {

            position: absolute;

            right: 38px;
            top: 30px;

            width: 82px;
            height: 100px;

            z-index: 20;

            display: flex;

            justify-content: center;
            align-items: center;

            background: rgba(255,255,255,.96);

            border-radius: 8px;

            padding: 4px;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 4px 12px rgba(0,0,0,.10);

            opacity: 1;

        }


        .back-congo img {

            width: 100%;
            height: 100%;

            object-fit: contain;

            opacity: 1;

            filter: none;

            display: block;

        }


        /* =========================================================
           CONTENU VERSO
        ========================================================== */

        .back-main {

            position: absolute;

            left: 55px;
            right: 55px;

            top: 165px;
            bottom: 55px;

            z-index: 15;

            display: flex;

            flex-direction: column;

            align-items: center;

        }


        /* =========================================================
           TITRE SÉCURITÉ
        ========================================================== */

        .security-title {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            font-size: 18px;

            font-weight: 900;

            color: var(--uneac-green);

            margin-bottom: 8px;

        }


        .security-title i {

            font-size: 22px;

        }


        /* =========================================================
           TEXTE SÉCURITÉ
        ========================================================== */

        .security-description {

            width: 520px;

            text-align: center;

            font-size: 12px;

            line-height: 1.35;

            color: var(--text-gray);

            margin: 0;

        }


        /* =========================================================
           QR CENTRE VERSO
        ========================================================== */

        .back-qr {

            margin-top: 12px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            z-index: 25;

        }


        .back-qr-box {

            width: 158px;
            height: 158px;

            padding: 7px;

            background: #ffffff;

            border:
                3px solid var(--uneac-green);

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            box-shadow:
                0 5px 15px rgba(0,0,0,.12);

        }


        .back-qr-box svg {

            width: 100%;
            height: 100%;

            display: block;

        }


        .back-qr-label {

            margin-top: 5px;

            font-size: 9px;

            font-weight: 900;

            letter-spacing: 1px;

            color: var(--uneac-green);

            text-transform: uppercase;

        }


        /* =========================================================
           BAS VERSO
        ========================================================== */

        .back-bottom {

            position: absolute;

            left: 55px;
            right: 55px;

            bottom: 48px;

            display: flex;

            justify-content: space-between;

            align-items: flex-end;

            z-index: 25;

        }


        /* =========================================================
           DATES
        ========================================================== */

        .dates {

            display: flex;

            gap: 12px;

        }


        .date-box {

            min-width: 140px;

            padding:
                7px 11px;

            border-left:
                4px solid var(--uneac-green);

            background:
                #f4f8f5;

            border-radius:
                0 5px 5px 0;

        }


        .date-label {

            font-size: 9px;

            line-height: 1.1;

            text-transform: uppercase;

            letter-spacing: .8px;

            color: #78817b;

        }


        .date-value {

            margin-top: 4px;

            font-size: 15px;

            line-height: 1.1;

            font-weight: 900;

            color: #252927;

        }


        /* =========================================================
           SIGNATURE PRÉSIDENT
        ========================================================== */

        .president {

            width: 220px;

            text-align: center;

        }


        .president-label {

            font-size: 10px;

            font-weight: 900;

            color: var(--uneac-green);

            text-transform: uppercase;

            letter-spacing: 1px;

        }


        .signature-line {

            width: 180px;

            height: 1px;

            background: var(--uneac-gold);

            margin:
                28px auto 5px;

        }


        .president-name {

            font-size: 11px;

            font-weight: 900;

            color: var(--text-gray);

            text-transform: uppercase;

        }


        .president-role {

            margin-top: 2px;

            font-size: 9px;

            font-weight: 700;

            text-transform: none;

            color: #7a827d;

        }

        .president-signature-image {

            display: block;

            width: 135px;

            height: 38px;

            object-fit: contain;

            margin: 4px auto 2px;

            opacity: .92;

        }


        /* =========================================================
           TEXTE DÉCORATIF BAS
        ========================================================== */

        .back-bottom-text {

            position: absolute;

            left: 40px;
            right: 40px;

            bottom: 12px;

            z-index: 30;

            text-align: center;

            font-size: 9px;

            font-weight: 800;

            letter-spacing: 1.2px;

            text-transform: uppercase;

            color: #7b847e;

        }


        .back-bottom-text span {

            color: var(--uneac-green);

        }


        /* =========================================================
           FILIGRANE CENTRAL VERSO
        ========================================================== */

        .back-watermark-emblem {

            position: absolute;

            left: 50%;

            top: 205px;

            width: 360px;

            height: 300px;

            transform: translateX(-50%);

            z-index: 4;

            opacity: .055;

            pointer-events: none;

        }

        .back-watermark-emblem img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            filter: grayscale(1);

        }

        .back-cultural-watermarks {

            position: absolute;

            inset: 0;

            z-index: 2;

            pointer-events: none;

            overflow: hidden;

        }

        .back-cultural-watermarks i {

            position: absolute;

            color: var(--uneac-green);

            opacity: .045;

            font-size: 92px;

        }

        .back-wm-book {

            left: 75px;

            bottom: 55px;

            transform: rotate(-15deg);

        }

        .back-wm-music {

            left: 365px;

            bottom: 45px;

            transform: rotate(8deg);

        }

        .back-wm-camera {

            right: 75px;

            bottom: 45px;

            transform: rotate(-10deg);

        }

        .back-wm-feather {

            left: 355px;

            top: 245px;

            transform: rotate(-20deg);

        }


        /* =========================================================
           FOOTER VERSO
        ========================================================== */

        .back-footer {

            position: absolute;

            left: 0;
            right: 0;

            bottom: 0;

            height: 9px;

            z-index: 40;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-gold) 0%,
                    var(--uneac-gold) 25%,
                    var(--uneac-green) 25%,
                    var(--uneac-green-dark) 100%
                );

        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 900px) {

            .page-container {

                padding: 20px 10px;

                overflow-x: auto;

            }

        }


        /* =========================================================
           IMPRESSION
        ========================================================== */

        @media print {

            @page {

                size:
                    85.60mm 53.98mm;

                margin: 0;

            }


            html,
            body {

                width:
                    85.60mm;

                margin: 0 !important;

                padding: 0 !important;

                background:
                    #ffffff !important;

            }


            body {

                -webkit-print-color-adjust:
                    exact !important;

                print-color-adjust:
                    exact !important;

            }


            .no-print {

                display:
                    none !important;

            }


            .page-container {

                width:
                    85.60mm;

                min-height:
                    0;

                padding:
                    0 !important;

                margin:
                    0 !important;

            }


            .cards-container {

                display:
                    block;

                width:
                    85.60mm;

                margin:
                    0;

                padding:
                    0;

            }


            .print-card-wrapper {

                width:
                    85.60mm;

                height:
                    53.98mm;

                position:
                    relative;

                overflow:
                    hidden;

                margin:
                    0;

                padding:
                    0;

                page-break-inside:
                    avoid;

                break-inside:
                    avoid;

            }


            .print-card-wrapper .uneac-card {

                width:
                    850px !important;

                height:
                    536px !important;

                max-width:
                    none !important;

                aspect-ratio:
                    auto !important;

                position:
                    absolute !important;

                left:
                    0 !important;

                top:
                    0 !important;

                margin:
                    0 !important;

                border-radius:
                    0 !important;

                box-shadow:
                    none !important;

                transform:
                    scale(0.3802352941) !important;

                transform-origin:
                    top left !important;

            }


            .print-card-wrapper.recto-wrapper {

                page-break-after:
                    always;

                break-after:
                    page;

            }


            .print-card-wrapper.verso-wrapper {

                page-break-after:
                    auto;

                break-after:
                    auto;

            }


            svg {

                shape-rendering:
                    crispEdges;

            }

        }



        /* =========================================================
           INTÉGRATION ADMINLTE
        ========================================================== */

        /*
         * AdminLTE devient l'enveloppe de l'écran.
         * La carte conserve strictement ses dimensions d'impression
         * 850 x 536 px et son design UNEAC.
         */

        .uneac-preview-adminlte {
            width: 100%;
        }

        .uneac-preview-adminlte .page-container {
            min-height: auto;
            padding: 10px 0 30px;
        }

        .uneac-preview-adminlte .actions {
            margin-top: 0;
        }

        /* Le fond de la page est celui d'AdminLTE.
           La carte reste blanche comme dans le design validé. */
        body {
            background: #f4f6f9;
        }

        /* Évite que le contenu AdminLTE réduise ou déforme la carte. */
        .uneac-preview-adminlte .cards-container {
            width: 100%;
        }

        /* Sur écran, les cartes restent centrées. */
        @media (min-width: 901px) {
            .uneac-preview-adminlte .cards-container {
                align-items: center;
            }
        }

        /* L'interface AdminLTE ne doit jamais apparaître sur la carte imprimée. */
        @media print {
            .main-header,
            .main-sidebar,
            .main-footer,
            .content-header,
            .no-print,
            .breadcrumb,
            .wrapper > .content-wrapper > .content-header {
                display: none !important;
            }

            .content-wrapper,
            .main-footer,
            .main-header {
                margin-left: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
            }

            .uneac-preview-adminlte,
            .content,
            .content-wrapper {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .uneac-preview-adminlte .page-container {
                padding: 0 !important;
                margin: 0 !important;
            }
        }
    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>


/* =============================================================
   ENREGISTRER RECTO + VERSO
============================================================= */

async function enregistrerCarteImage()
{

    const recto =
        document.getElementById('carte-recto');


    const verso =
        document.getElementById('carte-verso');


    const bouton =
        document.getElementById('btnEnregistrerImage');


    if (!recto || !verso) {

        alert(
            'Impossible de trouver le recto ou le verso.'
        );

        return;

    }


    if (typeof html2canvas === 'undefined') {

        alert(
            'La bibliothèque de génération d’image n’est pas disponible.'
        );

        return;

    }


    bouton.disabled = true;


    bouton.innerHTML =
        '<span class="spinner-border spinner-border-sm me-1"></span>' +
        'Génération...';


    try {


        /* =====================================================
           ATTENDRE LES IMAGES
        ====================================================== */

        await attendreImages(recto);

        await attendreImages(verso);



        /* =====================================================
           RECTO
        ====================================================== */

        const canvasRecto =
            await html2canvas(
                recto,
                {

                    scale: 4,

                    useCORS: true,

                    allowTaint: false,

                    backgroundColor: '#ffffff',

                    logging: false,

                    imageTimeout: 15000,

                    width: 850,

                    height: 536,

                    windowWidth: 850,

                    windowHeight: 536

                }
            );



        /* =====================================================
           VERSO
        ====================================================== */

        const canvasVerso =
            await html2canvas(
                verso,
                {

                    scale: 4,

                    useCORS: true,

                    allowTaint: false,

                    backgroundColor: '#ffffff',

                    logging: false,

                    imageTimeout: 15000,

                    width: 850,

                    height: 536,

                    windowWidth: 850,

                    windowHeight: 536

                }
            );



        /* =====================================================
           TÉLÉCHARGER RECTO
        ====================================================== */

        telechargerCanvas(
            canvasRecto,
            'UNEAC-ID-RECTO-{{ $card->numero_carte }}.png'
        );


        await attendre(800);



        /* =====================================================
           TÉLÉCHARGER VERSO
        ====================================================== */

        telechargerCanvas(
            canvasVerso,
            'UNEAC-ID-VERSO-{{ $card->numero_carte }}.png'
        );


    }
    catch(error) {

        console.error(
            'Erreur génération carte :',
            error
        );

        alert(
            'Une erreur est survenue lors de la génération des images.'
        );

    }
    finally {

        bouton.disabled = false;

        bouton.innerHTML =
            '<i class="bi bi-image me-1"></i>' +
            'Enregistrer en image';

    }

}



/* =============================================================
   ATTENDRE LES IMAGES
============================================================= */

function attendreImages(element)
{

    const images =
        Array.from(
            element.querySelectorAll('img')
        );


    return Promise.all(

        images.map(
            image => {

                if (image.complete) {

                    return Promise.resolve();

                }


                return new Promise(
                    resolve => {

                        image.onload =
                            resolve;

                        image.onerror =
                            resolve;

                    }
                );

            }
        )

    );

}



/* =============================================================
   ATTENDRE
============================================================= */

function attendre(milliseconds)
{

    return new Promise(

        resolve =>
            setTimeout(
                resolve,
                milliseconds
            )

    );

}



/* =============================================================
   TÉLÉCHARGER CANVAS
============================================================= */

function telechargerCanvas(
    canvas,
    nomFichier
)
{

    const lien =
        document.createElement('a');


    lien.href =
        canvas.toDataURL(
            'image/png',
            1.0
        );


    lien.download =
        nomFichier;


    document.body.appendChild(lien);


    lien.click();


    document.body.removeChild(lien);

}


</script>


@stop
