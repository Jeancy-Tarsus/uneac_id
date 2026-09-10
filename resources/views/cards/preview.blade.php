<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Carte UNEAC - {{ $card->numero_carte }}
    </title>


    {{-- Bootstrap --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Bootstrap Icons --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        /* =====================================================
           VARIABLES
        ===================================================== */

        :root {

            --uneac-green: #087f3f;

            --uneac-green-dark: #045c2d;

            --uneac-green-deep: #034b25;

            --uneac-green-light: #e8f3ed;

            --uneac-gold: #b8943d;

            --uneac-gold-light: #d8c27b;

            --text-dark: #202522;

            --text-muted: #687078;

        }


        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }


        html,
        body {

            margin: 0;
            padding: 0;

        }


        body {

            background: #eef1ef;

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

            align-items: center;

            gap: 10px;

            margin-bottom: 35px;

        }


        /* =====================================================
           CARTES
        ===================================================== */

        .cards-container {

            display: flex;

            flex-wrap: wrap;

            justify-content: center;

            align-items: flex-start;

            gap: 35px;

        }


        .uneac-card {

            width: 850px;

            max-width: 100%;

            aspect-ratio: 1.586 / 1;

            position: relative;

            overflow: hidden;

            background: #ffffff;

            border-radius: 16px;

            border: 1px solid #cfd9d3;

            box-shadow:
                0 18px 45px rgba(0, 0, 0, .14);

        }


        /* =====================================================
           CONTOURS
        ===================================================== */

        .uneac-card::before {

            content: "";

            position: absolute;

            inset: 8px;

            border: 1px solid rgba(8, 127, 63, .35);

            border-radius: 10px;

            pointer-events: none;

            z-index: 50;

        }


        .uneac-card::after {

            content: "";

            position: absolute;

            inset: 12px;

            border: 1px solid rgba(184, 148, 61, .25);

            border-radius: 8px;

            pointer-events: none;

            z-index: 50;

        }


        /* =====================================================
           FILIGRANE CULTUREL
        ===================================================== */

        .cultural-watermark {

            position: absolute;

            inset: 0;

            overflow: hidden;

            pointer-events: none;

            z-index: 1;

            color: var(--uneac-green);

        }


        .watermark-icon {

            position: absolute;

            display: flex;

            align-items: center;

            justify-content: center;

            color: var(--uneac-green);

            opacity: .055;

            filter: blur(.25px);

        }


        .watermark-icon i {

            line-height: 1;

        }


        .wm-book {

            right: 65px;

            top: 145px;

            font-size: 145px;

            transform: rotate(-8deg);

        }


        .wm-feather {

            right: 205px;

            bottom: 45px;

            font-size: 125px;

            transform: rotate(-25deg);

        }


        .wm-music {

            left: 250px;

            bottom: 20px;

            font-size: 115px;

            transform: rotate(8deg);

        }


        .wm-theatre {

            right: 350px;

            bottom: 25px;

            font-size: 105px;

            transform: rotate(-5deg);

        }


        .wm-palette {

            left: 250px;

            top: 135px;

            font-size: 115px;

            transform: rotate(12deg);

        }


        .wm-camera {

            right: 35px;

            bottom: 40px;

            font-size: 105px;

            transform: rotate(5deg);

        }


        .watermark-circle {

            position: absolute;

            width: 370px;

            height: 370px;

            right: -180px;

            top: 100px;

            border: 2px solid rgba(8,127,63,.055);

            border-radius: 50%;

        }


        .watermark-circle::before {

            content: "";

            position: absolute;

            inset: 25px;

            border: 1px solid rgba(184,148,61,.055);

            border-radius: 50%;

        }


        .watermark-circle::after {

            content: "";

            position: absolute;

            inset: 55px;

            border: 1px solid rgba(8,127,63,.045);

            border-radius: 50%;

        }


        .watermark-lines {

            position: absolute;

            width: 330px;

            height: 120px;

            left: 190px;

            bottom: 0;

            opacity: .045;

            transform: rotate(-8deg);

            background:
                repeating-linear-gradient(
                    -45deg,
                    var(--uneac-green) 0,
                    var(--uneac-green) 2px,
                    transparent 2px,
                    transparent 18px
                );

        }


        /* =====================================================
           DÉCORATIONS
        ===================================================== */

        .shape {

            position: absolute;

            pointer-events: none;

            z-index: 0;

        }


        .shape-green-corner {

            width: 260px;

            height: 150px;

            right: -145px;

            bottom: -95px;

            background: var(--uneac-green-light);

            transform: rotate(-18deg);

            border-radius: 30px;

            opacity: .85;

        }


        .shape-gold-corner {

            width: 150px;

            height: 150px;

            left: -100px;

            bottom: -95px;

            border: 16px solid rgba(184,148,61,.08);

            transform: rotate(45deg);

        }


        /* =====================================================
           ZIGZAG
        ===================================================== */

        .zigzag {

            position: absolute;

            width: 230px;

            height: 65px;

            opacity: .09;

            background:
                linear-gradient(
                    135deg,
                    transparent 0 18px,
                    var(--uneac-green) 18px 20px,
                    transparent 20px 38px
                );

            background-size: 40px 40px;

            pointer-events: none;

            z-index: 2;

        }


        .zigzag-top {

            right: -5px;

            top: 18px;

            transform: rotate(-8deg);

        }


        .zigzag-bottom {

            left: -5px;

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
           HEADER RECTO
        ===================================================== */

        .card-top {

            height: 115px;

            position: relative;

            z-index: 10;

            padding: 13px 30px;

            display: flex;

            align-items: center;

            gap: 20px;

            background:
                linear-gradient(
                    110deg,
                    var(--uneac-green-deep) 0%,
                    var(--uneac-green-dark) 50%,
                    var(--uneac-green) 100%
                );

            border-bottom: 4px solid var(--uneac-gold);

            color: white;

        }


        /* =====================================================
           MOTIF HEADER
        ===================================================== */

        .card-top .header-pattern {

            position: absolute;

            right: 0;

            top: 0;

            width: 310px;

            height: 115px;

            background:
                repeating-linear-gradient(
                    135deg,
                    rgba(255,255,255,.035) 0,
                    rgba(255,255,255,.035) 2px,
                    transparent 2px,
                    transparent 18px
                );

            pointer-events: none;

        }


        /* =====================================================
           LOGO RECTO
        ===================================================== */

        .logo-box {

            width: 75px;

            height: 75px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            background: #ffffff;

            border-radius: 50%;

            border: 3px solid #ffffff;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 4px 12px rgba(0,0,0,.18);

            position: relative;

            z-index: 15;

        }


        .logo-box img {

            width: 62px;

            height: 62px;

            object-fit: contain;

        }


        .logo-placeholder {

            color: var(--uneac-green);

            font-weight: 900;

            font-size: 18px;

        }


        /* =====================================================
           BLOC TEXTE RECTO
        ===================================================== */

        .header-text {

            flex: 1;

            position: relative;

            z-index: 15;

            text-align: center;

            padding-left: 15px;

            padding-right: 85px;

        }


        .header-country {

            font-size: 15px;

            font-weight: 900;

            letter-spacing: 1.8px;

            color: #ffffff;

            margin-bottom: 5px;

        }


        .header-title {

            max-width: 610px;

            margin: 0 auto;

            font-size: 20px;

            line-height: 1.15;

            font-weight: 900;

            text-transform: uppercase;

            color: #ffffff;

        }


        .header-subtitle {

            margin-top: 5px;

            font-size: 13px;

            font-weight: 900;

            color: var(--uneac-gold-light);

            letter-spacing: 2.5px;

        }


        /* =====================================================
           CARTE DU CONGO
        ===================================================== */

        .congo-map {

            position: absolute;

            right: 24px;

            top: 50%;

            transform: translateY(-50%);

            width: 66px;

            height: 82px;

            display: flex;

            align-items: center;

            justify-content: center;

            z-index: 12;

            opacity: .92;

        }


        .congo-map img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            filter:
                brightness(0)
                invert(1);

            opacity: .22;

        }


        .congo-map-label {

            position: absolute;

            bottom: -2px;

            left: 50%;

            transform: translateX(-50%);

            font-size: 7px;

            font-weight: 800;

            letter-spacing: 1px;

            color: rgba(255,255,255,.60);

            white-space: nowrap;

        }


        /* =====================================================
           CORPS RECTO
        ===================================================== */

        .front-body {

            position: relative;

            z-index: 10;

            padding: 28px 32px 18px;

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

            border: 3px solid #ffffff;

            outline: 2px solid var(--uneac-green);

            box-shadow:
                0 5px 15px rgba(0,0,0,.12);

        }


        .photo-placeholder {

            display: flex;

            align-items: center;

            justify-content: center;

            background: var(--uneac-green-light);

            color: var(--uneac-green);

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

            font-size: 11px;

            font-weight: 900;

            text-transform: uppercase;

            letter-spacing: 1.1px;

            color: var(--uneac-green);

            margin-bottom: 5px;

        }


        .member-name {

            font-size: 27px;

            line-height: 1.08;

            font-weight: 900;

            text-transform: uppercase;

            color: #1d211f;

            margin-bottom: 23px;

        }


        .info-grid {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px 25px;

        }


        .info-value {

            font-size: 15px;

            font-weight: 600;

            color: #343936;

        }


        /* =====================================================
           NUMÉRO CARTE
        ===================================================== */

        .member-number {

            display: inline-flex;

            align-items: center;

            margin-top: 25px;

            padding: 10px 19px;

            border-radius: 5px;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-green-dark),
                    var(--uneac-green)
                );

            color: white;

            font-size: 15px;

            font-weight: 900;

            letter-spacing: 1.2px;

            box-shadow:
                0 4px 10px rgba(8,127,63,.22);

            border-left: 4px solid var(--uneac-gold);

        }


        /* =====================================================
           BAS RECTO
        ===================================================== */

        .front-bottom {

            position: absolute;

            left: 32px;

            right: 32px;

            bottom: 18px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-top: 1px solid rgba(8,127,63,.18);

            border-bottom: 1px solid rgba(184,148,61,.20);

            z-index: 15;

            background: rgba(255,255,255,.35);

        }


        .front-bottom-text {

            font-size: 9px;

            font-weight: 900;

            letter-spacing: 1.6px;

            color: var(--uneac-green);

            text-transform: uppercase;

        }


        .front-bottom-dot {

            width: 5px;

            height: 5px;

            margin: 0 10px;

            border-radius: 50%;

            background: var(--uneac-gold);

        }


        /* =====================================================
           FOOTER RECTO
        ===================================================== */

        .card-footer-line {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            height: 9px;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-green-deep) 0%,
                    var(--uneac-green) 72%,
                    var(--uneac-gold) 72%,
                    var(--uneac-gold) 100%
                );

            z-index: 20;

        }


        /* =====================================================
           VERSO
        ===================================================== */

        .card-back {

            background: #ffffff;

        }


        /* =====================================================
           HEADER VERSO
        ===================================================== */

        .back-header {

            position: relative;

            z-index: 10;

            height: 108px;

            padding: 10px 30px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            background:
                linear-gradient(
                    110deg,
                    var(--uneac-green-deep) 0%,
                    var(--uneac-green-dark) 50%,
                    var(--uneac-green) 100%
                );

            border-bottom: 4px solid var(--uneac-gold);

            color: white;

        }


        .back-header::before {

            content: "";

            position: absolute;

            right: -80px;

            top: -90px;

            width: 260px;

            height: 180px;

            background: rgba(255,255,255,.055);

            transform: rotate(-20deg);

            pointer-events: none;

        }


        /* =====================================================
           LOGO VERSO
        ===================================================== */

        .back-logo {

            position: absolute;

            left: 28px;

            top: 50%;

            transform: translateY(-50%);

            width: 58px;

            height: 58px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffffff;

            border-radius: 50%;

            border: 3px solid #ffffff;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 4px 12px rgba(0,0,0,.20);

            overflow: hidden;

            z-index: 15;

        }


        .back-logo img {

            width: 49px;

            height: 49px;

            object-fit: contain;

        }


        .back-logo span {

            font-size: 9px;

            font-weight: 900;

            color: var(--uneac-green);

        }


        /* =====================================================
           TITRE VERSO
        ===================================================== */

        .back-header h2 {

            margin: 0;

            color: #ffffff;

            font-size: 28px;

            font-weight: 900;

            letter-spacing: 2.5px;

            line-height: 1;

            position: relative;

            z-index: 15;

        }


        .back-header p {

            margin: 7px 0 0;

            font-size: 11px;

            color: var(--uneac-gold-light);

            font-weight: 900;

            letter-spacing: 2px;

            position: relative;

            z-index: 15;

        }


        .back-header-decoration {

            position: absolute;

            right: 0;

            top: 0;

            width: 150px;

            height: 100%;

            opacity: .08;

            background:
                repeating-linear-gradient(
                    135deg,
                    #ffffff 0,
                    #ffffff 2px,
                    transparent 2px,
                    transparent 16px
                );

            pointer-events: none;

        }


        /* =====================================================
           CONTENU VERSO
        ===================================================== */

        .back-content {

            position: relative;

            z-index: 10;

            height: calc(100% - 117px);

            padding: 24px 32px 45px;

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

            gap: 7px;

            margin-bottom: 15px;

            font-size: 17px;

            font-weight: 900;

            color: var(--uneac-green);

        }


        .security-title i {

            font-size: 21px;

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

            border-left: 4px solid var(--uneac-green);

            background: #f4f8f5;

            border-radius: 0 5px 5px 0;

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

            font-weight: 900;

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

            background: #ffffff;

            border: 3px solid var(--uneac-green);

            border-radius: 9px;

            box-shadow:
                0 5px 15px rgba(0,0,0,.10);

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

            font-weight: 900;

            text-transform: uppercase;

            letter-spacing: 1px;

            color: var(--uneac-green);

        }


        /* =====================================================
           TEXTE BAS VERSO
        ===================================================== */

        .back-bottom-text {

            position: absolute;

            left: 32px;

            right: 32px;

            bottom: 17px;

            z-index: 15;

            text-align: center;

            font-size: 8px;

            font-weight: 800;

            letter-spacing: 1.3px;

            text-transform: uppercase;

            color: #7b847e;

        }


        .back-bottom-text span {

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

            z-index: 20;

            height: 9px;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-gold) 0%,
                    var(--uneac-gold) 25%,
                    var(--uneac-green) 25%,
                    var(--uneac-green-dark) 100%
                );

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

                width: 50px;

                height: 50px;

            }


            .header-text {

                padding-left: 0;

                padding-right: 50px;

            }


            .header-country {

                font-size: 9px;

                letter-spacing: 1px;

            }


            .header-title {

                font-size: 12px;

            }


            .header-subtitle {

                font-size: 8px;

            }


            .congo-map {

                right: 10px;

                width: 42px;

                height: 55px;

            }


            .congo-map-label {

                display: none;

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


            .card-label {

                font-size: 8px;

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


            .front-bottom {

                left: 18px;

                right: 18px;

            }


            .front-bottom-text {

                font-size: 6px;

                letter-spacing: 1px;

            }


            .back-header {

                height: 90px;

            }


            .back-logo {

                width: 42px;

                height: 42px;

                left: 18px;

            }


            .back-logo img {

                width: 35px;

                height: 35px;

            }


            .back-header h2 {

                font-size: 19px;

            }


            .back-header p {

                font-size: 7px;

            }


            .back-content {

                padding: 18px 18px 40px;

                gap: 15px;

            }


            .security-text p {

                font-size: 9px;

            }


            .security-title {

                font-size: 13px;

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


            .back-bottom-text {

                left: 18px;

                right: 18px;

                font-size: 6px;

            }


            .watermark-icon {

                opacity: .04;

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
         ACTIONS
    ===================================================== --}}

    <div class="actions no-print">


        <a href="{{ route('cards.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Retour aux cartes

        </a>


        <button
            type="button"
            onclick="window.print()"
            class="btn btn-success"
        >

            <i class="bi bi-printer me-1"></i>

            Imprimer la carte

        </button>


    </div>



    <div class="cards-container">


        {{-- =================================================
             RECTO
        ================================================== --}}

        <div class="uneac-card card-front">


            {{-- FILIGRANE CULTUREL --}}

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

            <div class="card-top">


                <div class="header-pattern"></div>



                {{-- LOGO --}}

                <div class="logo-box">


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



                {{-- TEXTE CENTRÉ --}}

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



                {{-- =================================================
                     CARTE DU CONGO
                ================================================== --}}

                @if(file_exists(public_path('images/carte-congo.png')))

                    <div class="congo-map">


                        <img
                            src="{{ asset('images/carte-congo.png') }}"
                            alt="République du Congo"
                        >


                        <div class="congo-map-label">

                            CONGO

                        </div>


                    </div>

                @endif


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


                    <div class="card-label">

                        CARTE DE MEMBRE

                    </div>


                    <div class="member-name">

                        {{ $card->member->nom }}

                        {{ $card->member->postnom }}

                        {{ $card->member->prenom }}

                    </div>



                    <div class="info-grid">


                        {{-- PROFESSION --}}

                        <div>

                            <div class="card-label">

                                Profession

                            </div>


                            <div class="info-value">

                                {{ $card->member->profession_artistique ?: 'Non renseignée' }}

                            </div>

                        </div>



                        {{-- CATÉGORIE --}}

                        <div>

                            <div class="card-label">

                                Catégorie

                            </div>


                            <div class="info-value">

                                {{ $card->member->category?->nom ?: 'Non renseignée' }}

                            </div>

                        </div>



                        {{-- FÉDÉRATION --}}

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



                        {{-- NUMÉRO MEMBRE --}}

                        <div>

                            <div class="card-label">

                                Numéro membre

                            </div>


                            <div class="info-value">

                                {{ $card->member->numero_membre }}

                            </div>

                        </div>


                    </div>



                    {{-- NUMÉRO CARTE --}}

                    <div class="member-number">

                        {{ $card->numero_carte }}

                    </div>


                </div>


            </div>



            {{-- =================================================
                 BAS RECTO
            ================================================== --}}

            <div class="front-bottom">


                <div class="front-bottom-text">

                    IDENTITÉ

                </div>


                <div class="front-bottom-dot"></div>


                <div class="front-bottom-text">

                    CULTURE

                </div>


                <div class="front-bottom-dot"></div>


                <div class="front-bottom-text">

                    ART

                </div>


            </div>



            {{-- FOOTER --}}

            <div class="card-footer-line"></div>


        </div>



        {{-- =================================================
             VERSO
        ================================================== --}}

        <div class="uneac-card card-back">


            {{-- FILIGRANE --}}

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


                <div class="watermark-circle"></div>


                <div class="watermark-lines"></div>


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


                <div class="back-header-decoration"></div>


                {{-- LOGO À GAUCHE --}}

                <div class="back-logo">


                    @if(file_exists(public_path('images/uneac-logo.png')))

                        <img
                            src="{{ asset('images/uneac-logo.png') }}"
                            alt="Logo UNEAC"
                        >

                    @else

                        <span>

                            UNEAC

                        </span>

                    @endif


                </div>

                {{-- =================================================
                     CARTE DU CONGO
                ================================================== --}}

                @if(file_exists(public_path('images/carte-congo.png')))

                    <div class="congo-map">


                        <img
                            src="{{ asset('images/carte-congo.png') }}"
                            alt="République du Congo"
                        >


                        <div class="congo-map-label">

                            CONGO

                        </div>


                    </div>

                @endif


                {{-- TITRE CENTRÉ --}}

                <h2>

                    UNEAC ID

                </h2>


                <p>

                    CARTE PROFESSIONNELLE DE MEMBRE

                </p>


            </div>



            {{-- =================================================
                 CONTENU VERSO
            ================================================== --}}

            <div class="back-content">


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


                </div>



                {{-- =================================================
                     QR CODE
                ================================================== --}}

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



            {{-- =================================================
                 TEXTE BAS VERSO
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


</body>

</html>
