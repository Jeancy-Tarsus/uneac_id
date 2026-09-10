<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Carte UNEAC - {{ $card->numero_carte }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        /* =====================================================
           VARIABLES
        ===================================================== */

        :root {

            --uneac-green: #087f3f;
            --uneac-green-dark: #045c2d;

            --uneac-gold: #b8943d;

            --text-dark: #202124;
            --text-muted: #687078;

            --border: #dfe5e1;

        }


        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            background: #f4f5f4;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: var(--text-dark);

        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page-container {

            min-height: 100vh;

            padding: 40px 20px;

        }


        /* =====================================================
           ACTIONS
        ===================================================== */

        .actions {

            display: flex;

            justify-content: center;

            gap: 10px;

            margin-bottom: 35px;

        }


        /* =====================================================
           CONTAINER CARTES
        ===================================================== */

        .cards-container {

            display: flex;

            flex-wrap: wrap;

            justify-content: center;

            gap: 35px;

        }


        /* =====================================================
           CARTE
        ===================================================== */

        .uneac-card {

            width: 850px;

            max-width: 100%;

            aspect-ratio: 1.586 / 1;

            position: relative;

            overflow: hidden;

            background: #ffffff;

            border-radius: 16px;

            border: 1px solid #d5ddd8;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, .12);

        }


        /*
        Contour intérieur élégant
        */

        .uneac-card::before {

            content: "";

            position: absolute;

            inset: 8px;

            border: 1px solid rgba(8, 127, 63, .25);

            border-radius: 10px;

            pointer-events: none;

            z-index: 20;

        }


        /*
        Petit liseré doré
        */

        .uneac-card::after {

            content: "";

            position: absolute;

            inset: 12px;

            border: 1px solid rgba(184, 148, 61, .16);

            border-radius: 8px;

            pointer-events: none;

            z-index: 20;

        }


        /* =====================================================
           MOTIFS GÉOMÉTRIQUES
        ===================================================== */

        .shape {

            position: absolute;

            pointer-events: none;

            z-index: 0;

        }


        .shape-green-1 {

            width: 300px;

            height: 300px;

            right: -170px;

            top: -180px;

            border: 45px solid rgba(8, 127, 63, .035);

            transform: rotate(45deg);

        }


        .shape-green-2 {

            width: 240px;

            height: 240px;

            right: -130px;

            bottom: -150px;

            border: 35px solid rgba(8, 127, 63, .045);

            transform: rotate(45deg);

        }


        .shape-gold {

            width: 180px;

            height: 180px;

            left: -120px;

            bottom: -100px;

            border: 18px solid rgba(184, 148, 61, .055);

            transform: rotate(45deg);

        }


        /*
        Zigzag très discret
        */

        .zigzag {

            position: absolute;

            width: 240px;

            height: 60px;

            opacity: .07;

            background:
                linear-gradient(
                    135deg,
                    transparent 0 18px,
                    var(--uneac-green) 18px 20px,
                    transparent 20px 38px
                );

            background-size: 40px 40px;

            transform: rotate(-8deg);

            pointer-events: none;

            z-index: 0;

        }


        .zigzag-top {

            right: -20px;

            top: 25px;

        }


        .zigzag-bottom {

            left: -20px;

            bottom: 20px;

            transform: rotate(172deg);

        }


        /* =====================================================
           RECTO
        ===================================================== */

        .card-front {

            background: #ffffff;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .card-top {

            height: 115px;

            position: relative;

            z-index: 2;

            padding: 18px 30px;

            display: flex;

            align-items: center;

            gap: 20px;

            background: #ffffff;

            border-bottom: 3px solid var(--uneac-green);

        }


        /*
        Petite bande verte supérieure
        */

        .card-top::before {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            width: 100%;

            height: 5px;

            background: var(--uneac-green);

        }


        /*
        Accent doré
        */

        .card-top::after {

            content: "";

            position: absolute;

            left: 0;

            bottom: -3px;

            width: 32%;

            height: 3px;

            background: var(--uneac-gold);

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo-box {

            width: 75px;

            height: 75px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            background: white;

            border-radius: 50%;

            border: 2px solid var(--uneac-green);

            box-shadow:
                0 3px 10px rgba(0,0,0,.08);

        }


        .logo-box img {

            width: 64px;

            height: 64px;

            object-fit: contain;

        }


        .logo-placeholder {

            color: var(--uneac-green);

            font-weight: 800;

            font-size: 18px;

        }


        /* =====================================================
           TEXTE HEADER
        ===================================================== */

        .header-text {

            line-height: 1.25;

        }


        .header-country {

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 1.5px;

            color: var(--uneac-green);

            margin-bottom: 3px;

        }


        .header-title {

            max-width: 650px;

            font-size: 19px;

            line-height: 1.2;

            font-weight: 800;

            text-transform: uppercase;

            color: #222;

        }


        .header-subtitle {

            margin-top: 3px;

            font-size: 12px;

            font-weight: 600;

            color: var(--text-muted);

            letter-spacing: 2px;

        }


        /* =====================================================
           CORPS RECTO
        ===================================================== */

        .front-body {

            position: relative;

            z-index: 2;

            padding: 28px 32px;

            display: flex;

            gap: 30px;

        }


        /* =====================================================
           PHOTO
        ===================================================== */

        .member-photo,
        .photo-placeholder {

            width: 190px;

            height: 225px;

            flex-shrink: 0;

            object-fit: cover;

            border-radius: 8px;

            border: 1px solid #d9dfdc;

            box-shadow:
                0 4px 12px rgba(0,0,0,.08);

        }


        .photo-placeholder {

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f5f7f6;

            color: #aab2ad;

            font-size: 55px;

        }


        /* =====================================================
           INFORMATIONS
        ===================================================== */

        .member-info {

            flex: 1;

            padding-top: 4px;

        }


        .card-label {

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;

            color: var(--uneac-green);

            margin-bottom: 4px;

        }


        .member-name {

            font-size: 26px;

            line-height: 1.1;

            font-weight: 800;

            text-transform: uppercase;

            color: #1d1f20;

            margin-bottom: 22px;

        }


        .info-grid {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px 25px;

        }


        .info-value {

            font-size: 14px;

            font-weight: 600;

            color: #34383b;

        }


        /* =====================================================
           NUMÉRO CARTE
        ===================================================== */

        .member-number {

            display: inline-flex;

            align-items: center;

            margin-top: 25px;

            padding: 8px 16px;

            border-radius: 5px;

            background: var(--uneac-green);

            color: white;

            font-size: 14px;

            font-weight: 800;

            letter-spacing: 1px;

            box-shadow:
                0 3px 8px rgba(8,127,63,.18);

        }


        /* =====================================================
           FOOTER RECTO
        ===================================================== */

        .card-footer-line {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            height: 7px;

            background: var(--uneac-green);

            z-index: 3;

        }


        .card-footer-line::after {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            width: 28%;

            height: 2px;

            background: var(--uneac-gold);

        }


        /* =====================================================
           VERSO
        ===================================================== */

        .card-back {

            background: #ffffff;

        }


        .back-header {

            position: relative;

            z-index: 2;

            height: 88px;

            padding: 18px 30px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            background: #ffffff;

            border-bottom: 2px solid var(--uneac-green);

        }


        .back-header h2 {

            margin: 0;

            color: var(--uneac-green);

            font-size: 24px;

            font-weight: 900;

            letter-spacing: 1px;

        }


        .back-header p {

            margin: 3px 0 0;

            font-size: 11px;

            color: var(--text-muted);

            font-weight: 700;

            letter-spacing: 1.5px;

        }


        /* =====================================================
           CONTENU VERSO
        ===================================================== */

        .back-content {

            position: relative;

            z-index: 2;

            height: calc(100% - 95px);

            padding: 25px 32px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 35px;

        }


        .security-text {

            flex: 1;

            max-width: 570px;

        }


        .security-title {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 15px;

            font-size: 15px;

            font-weight: 800;

            color: var(--uneac-green);

        }


        .security-title i {

            font-size: 19px;

        }


        .security-text p {

            margin-bottom: 11px;

            font-size: 11px;

            line-height: 1.55;

            color: #59615c;

        }


        /* =====================================================
           DATES
        ===================================================== */

        .dates {

            display: flex;

            gap: 15px;

            margin-top: 18px;

        }


        .date-box {

            min-width: 130px;

            padding: 9px 12px;

            border-left: 3px solid var(--uneac-green);

            background: #f7f9f7;

        }


        .date-label {

            font-size: 9px;

            text-transform: uppercase;

            letter-spacing: .8px;

            color: #78817b;

        }


        .date-value {

            margin-top: 3px;

            font-size: 13px;

            font-weight: 800;

            color: #252927;

        }


        /* =====================================================
           QR
        ===================================================== */

        .qr-section {

            width: 180px;

            flex-shrink: 0;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

        }


        .qr-box {

            width: 145px;

            height: 145px;

            padding: 9px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: white;

            border: 1px solid #d7ddd9;

            border-radius: 8px;

            box-shadow:
                0 5px 15px rgba(0,0,0,.07);

        }


        .qr-box img,
        .qr-box svg {

            width: 100%;

            height: 100%;

        }


        .qr-label {

            margin-top: 8px;

            text-align: center;

            font-size: 9px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;

            color: var(--uneac-green);

        }


        /* =====================================================
           FOOTER VERSO
        ===================================================== */

        .back-footer {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            z-index: 3;

            height: 7px;

            background: var(--uneac-green);

        }


        .back-footer::after {

            content: "";

            position: absolute;

            right: 0;

            top: 0;

            width: 28%;

            height: 2px;

            background: var(--uneac-gold);

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .page-container {

                padding: 20px 10px;

            }

            .actions {

                margin-bottom: 20px;

            }

            .uneac-card {

                border-radius: 10px;

            }

            .card-top {

                height: 90px;

                padding: 12px 18px;

                gap: 12px;

            }

            .logo-box {

                width: 60px;

                height: 60px;

            }

            .logo-box img {

                width: 52px;

                height: 52px;

            }

            .header-country {

                font-size: 9px;

            }

            .header-title {

                font-size: 12px;

            }

            .header-subtitle {

                font-size: 8px;

            }

            .front-body {

                padding: 18px;

                gap: 15px;

            }

            .member-photo,
            .photo-placeholder {

                width: 120px;

                height: 150px;

            }

            .member-name {

                font-size: 18px;

                margin-bottom: 12px;

            }

            .info-grid {

                grid-template-columns: 1fr;

                gap: 8px;

            }

            .info-value {

                font-size: 10px;

            }

            .member-number {

                font-size: 10px;

                padding: 6px 9px;

                margin-top: 12px;

            }

            .back-content {

                padding: 18px;

                gap: 15px;

            }

            .security-text p {

                font-size: 9px;

            }

            .qr-section {

                width: 125px;

            }

            .qr-box {

                width: 105px;

                height: 105px;

            }

            .date-box {

                min-width: 100px;

            }

        }


        /* =====================================================
           IMPRESSION
        ===================================================== */

        @media print {

            @page {

                size: 85.60mm 53.98mm;

                margin: 0;

            }


            body {

                background: white;

            }


            .no-print {

                display: none !important;

            }


            .page-container {

                padding: 0;

            }


            .cards-container {

                display: block;

            }


            .uneac-card {

                width: 85.60mm;

                height: 53.98mm;

                max-width: none;

                aspect-ratio: auto;

                margin: 0;

                border-radius: 0;

                box-shadow: none;

                page-break-inside: avoid;

            }


            .card-front,
            .card-back {

                page-break-after: always;

            }

        }

    </style>

</head>


<body>


<div class="page-container">


    {{-- =====================================================
         BOUTONS
    ====================================================== --}}

    <div class="actions no-print">

        <a href="{{ route('cards.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Retour aux cartes

        </a>


        <button type="button"
                onclick="window.print()"
                class="btn btn-success">

            <i class="bi bi-printer me-1"></i>

            Imprimer la carte

        </button>

    </div>



    <div class="cards-container">


        {{-- =================================================
             RECTO
        ================================================== --}}

        <div class="uneac-card card-front">


            {{-- DÉCORATIONS --}}

            <div class="shape shape-green-1"></div>

            <div class="shape shape-green-2"></div>

            <div class="shape shape-gold"></div>

            <div class="zigzag zigzag-top"></div>

            <div class="zigzag zigzag-bottom"></div>


            {{-- HEADER --}}

            <div class="card-top">


                <div class="logo-box">

                    @if(file_exists(public_path('images/uneac-logo.png')))

                        <img src="{{ asset('images/uneac-logo.png') }}"
                             alt="Logo UNEAC">

                    @else

                        <div class="logo-placeholder">
                            UNEAC
                        </div>

                    @endif

                </div>


                <div class="header-text">

                    <div class="header-country">

                        RÉPUBLIQUE DU CONGO

                    </div>


                    <div class="header-title">

                        UNION NATIONALE DES ÉCRIVAINS
                        ET ARTISTES CONGOLAIS

                    </div>


                    <div class="header-subtitle">

                        UNEAC

                    </div>

                </div>

            </div>


            {{-- CORPS --}}

            <div class="front-body">


                {{-- PHOTO --}}

                @if($card->member->photo)

                    <img src="{{ asset('storage/' . $card->member->photo) }}"
                         alt="Photo du membre"
                         class="member-photo">

                @else

                    <div class="photo-placeholder">

                        <i class="bi bi-person-fill"></i>

                    </div>

                @endif


                {{-- INFORMATIONS --}}

                <div class="member-info">


                    <div class="card-label">

                        CARTE DE MEMBRE

                    </div>


                    <div class="member-name">

                        {{ $card->member->nom }}

                        {{ $card->member->postnom }}

                        {{ $card->member->prenom }}

                    </div>


                    <div class="info-grid">


                        <div>

                            <div class="card-label">
                                Profession
                            </div>

                            <div class="info-value">

                                {{ $card->member->profession_artistique ?: 'Non renseignée' }}

                            </div>

                        </div>


                        <div>

                            <div class="card-label">
                                Catégorie
                            </div>

                            <div class="info-value">

                                {{ $card->member->category?->nom ?: 'Non renseignée' }}

                            </div>

                        </div>


                        <div>

                            <div class="card-label">
                                Fédération
                            </div>

                            <div class="info-value">

                                {{ $card->member->federation?->sigle
                                    ?: $card->member->federation?->nom
                                    ?: 'Non renseignée' }}

                            </div>

                        </div>


                        <div>

                            <div class="card-label">
                                Numéro membre
                            </div>

                            <div class="info-value">

                                {{ $card->member->numero_membre }}

                            </div>

                        </div>


                    </div>


                    <div class="member-number">

                        {{ $card->numero_carte }}

                    </div>

                </div>

            </div>


            <div class="card-footer-line"></div>

        </div>



        {{-- =================================================
             VERSO
        ================================================== --}}

        <div class="uneac-card card-back">


            {{-- DÉCORATIONS --}}

            <div class="shape shape-green-1"></div>

            <div class="shape shape-green-2"></div>

            <div class="shape shape-gold"></div>

            <div class="zigzag zigzag-top"></div>

            <div class="zigzag zigzag-bottom"></div>


            {{-- HEADER --}}

            <div class="back-header">

                <h2>

                    UNEAC ID

                </h2>


                <p>

                    CARTE PROFESSIONNELLE DE MEMBRE

                </p>

            </div>


            {{-- CONTENU --}}

            <div class="back-content">


                {{-- TEXTE --}}

                <div class="security-text">


                    <div class="security-title">

                        <i class="bi bi-shield-check"></i>

                        Carte officielle de membre

                    </div>


                    <p>

                        Cette carte est personnelle et permet
                        d'identifier son titulaire en qualité de
                        membre de l'UNEAC.

                    </p>


                    <p>

                        Toute personne peut vérifier
                        l'authenticité et le statut de cette carte
                        en scannant le QR Code.

                    </p>


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

                </div>


                {{-- QR CODE --}}

                <div class="qr-section">


                    <div class="qr-box">

                        {!! QrCode::size(130)
                            ->generate(
                                route(
                                    'verification.show',
                                    $card->qr_token
                                )
                            )
                        !!}

                    </div>


                    <div class="qr-label">

                        Scanner pour vérifier

                    </div>

                </div>

            </div>


            <div class="back-footer"></div>

        </div>

    </div>

</div>

</body>

</html>
