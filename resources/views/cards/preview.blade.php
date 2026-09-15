<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Carte UNEAC - {{ $card->numero_carte }}
    </title>


    <!-- =========================================================
         BOOTSTRAP
    ========================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =========================================================
         BOOTSTRAP ICONS
    ========================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --green-dark: #012c1c;
            --green: #034f30;
            --green-light: #086b40;

            --gold: #c49a32;
            --gold-light: #e6c85c;
            --gold-dark: #94701f;

            --white: #ffffff;

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
        }


        body {

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #edf0ed;

            color: #222;

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .page-container {

            min-height: 100vh;

            padding: 35px 20px;

        }


        /* =========================================================
           BOUTONS
        ========================================================== */

        .actions {

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 10px;

            margin-bottom: 35px;

            flex-wrap: wrap;

        }


        /* =========================================================
           CONTAINER CARTES
        ========================================================== */

        .cards-container {

            display: flex;

            flex-direction: column;

            align-items: center;

            gap: 45px;

        }


        /* =========================================================
           WRAPPER IMPRESSION
        ========================================================== */

        .print-card-wrapper {

            width: 850px;

            height: 536px;

            position: relative;

        }


        /* =========================================================
           CARTE
        ========================================================== */

        .uneac-card {

            width: 850px;

            height: 536px;

            position: relative;

            overflow: hidden;

            border-radius: 22px;

            background:
                linear-gradient(
                    135deg,
                    #012d1d 0%,
                    #034b2d 45%,
                    #01351f 100%
                );

            border: 3px solid var(--gold);

            box-shadow:
                0 20px 45px rgba(0,0,0,.28);

        }


        /* =========================================================
           CADRE INTERIEUR
        ========================================================== */

        .uneac-card::before {

            content: "";

            position: absolute;

            inset: 11px;

            border: 2px solid
                rgba(222,190,82,.75);

            border-radius: 15px;

            pointer-events: none;

            z-index: 50;

        }


        .uneac-card::after {

            content: "";

            position: absolute;

            inset: 17px;

            border: 1px solid
                rgba(222,190,82,.30);

            border-radius: 11px;

            pointer-events: none;

            z-index: 50;

        }


        /* =========================================================
           TEXTURE DE FOND
        ========================================================== */

        .background-pattern {

            position: absolute;

            inset: 0;

            opacity: .055;

            background:

                radial-gradient(
                    circle at 20% 20%,
                    #ffffff 0,
                    transparent 2px
                ),

                radial-gradient(
                    circle at 70% 70%,
                    #ffffff 0,
                    transparent 2px
                );

            background-size:
                28px 28px,
                35px 35px;

            pointer-events: none;

            z-index: 1;

        }


        /* =========================================================
           =========================================================
                  FILIGRANES ARTISTIQUES
           =========================================================
        ========================================================== */

        .art-watermarks {

            position: absolute;

            inset: 0;

            overflow: hidden;

            pointer-events: none;

            z-index: 4;

        }


        /* =========================================================
           STYLE GENERAL DES FILIGRANES
        ========================================================== */

        .art-watermark {

            position: absolute;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #e6c85c;

            opacity: .055;

            line-height: 1;

            filter: blur(.15px);

        }


        /* =========================================================
           APPAREIL PHOTO
        ========================================================== */

        .wm-camera {

            right: 65px;

            bottom: 95px;

            font-size: 125px;

            transform: rotate(-8deg);

        }


        /* =========================================================
           CAMERA VIDEO
        ========================================================== */

        .wm-camera-video {

            right: 245px;

            bottom: 35px;

            font-size: 95px;

            transform: rotate(7deg);

        }


        /* =========================================================
           LIVRE
        ========================================================== */

        .wm-book {

            right: 375px;

            bottom: 30px;

            font-size: 105px;

            transform: rotate(-6deg);

        }


        /* =========================================================
           PLUME
        ========================================================== */

        .wm-feather {

            right: 500px;

            bottom: 75px;

            font-size: 90px;

            transform: rotate(-25deg);

        }


        /* =========================================================
           PALETTE
        ========================================================== */

        .wm-palette {

            right: 175px;

            bottom: 115px;

            font-size: 100px;

            transform: rotate(12deg);

        }


        /* =========================================================
           MUSIQUE
        ========================================================== */

        .wm-music {

            right: 310px;

            bottom: 125px;

            font-size: 80px;

            transform: rotate(10deg);

        }


        /* =========================================================
           THEATRE
        ========================================================== */

        .wm-theatre {

            right: 465px;

            bottom: 20px;

            font-size: 90px;

            transform: rotate(-7deg);

        }


        /* =========================================================
           CINEMA
        ========================================================== */

        .wm-film {

            right: 30px;

            bottom: 35px;

            font-size: 90px;

            transform: rotate(5deg);

        }


        /* =========================================================
           MICROPHONE
        ========================================================== */

        .wm-mic {

            right: 120px;

            bottom: 175px;

            font-size: 70px;

            transform: rotate(-8deg);

        }


        /* =========================================================
           DECORATION CIRCULAIRE
        ========================================================== */

        .gold-decoration {

            position: absolute;

            right: -100px;

            bottom: -110px;

            width: 390px;

            height: 250px;

            border-radius: 50%;

            border: 2px solid
                rgba(213,180,70,.12);

            transform: rotate(-15deg);

            z-index: 2;

            pointer-events: none;

        }


        .gold-decoration::before {

            content: "";

            position: absolute;

            inset: 25px;

            border: 1px solid
                rgba(213,180,70,.10);

            border-radius: 50%;

        }


        .gold-decoration::after {

            content: "";

            position: absolute;

            inset: 55px;

            border: 1px solid
                rgba(213,180,70,.08);

            border-radius: 50%;

        }


        /* =========================================================
           LOGO
        ========================================================== */

        .logo-box {

            width: 92px;

            height: 92px;

            border-radius: 50%;

            background: #ffffff;

            border: 4px solid var(--gold);

            box-shadow:

                0 0 0 2px #0d3f29,

                0 5px 15px rgba(0,0,0,.35);

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

        }


        .logo-box img {

            width: 78px;

            height: 78px;

            object-fit: contain;

            display: block;

        }


        .logo-placeholder {

            font-size: 19px;

            font-weight: 900;

            color: var(--green);

        }


        /* =========================================================
           =========================================================
                            RECTO
           =========================================================
        ========================================================== */


        .front-header {

            position: relative;

            z-index: 10;

            height: 150px;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            padding: 15px 145px 15px 110px;

            border-bottom:
                2px solid var(--gold);

        }


        /* =========================================================
           LOGO RECTO
        ========================================================== */

        .front-logo {

            position: absolute;

            right: 35px;

            top: 27px;

            z-index: 20;

        }


        /* =========================================================
           PAYS
        ========================================================== */

        .country {

            font-size: 18px;

            font-weight: 900;

            letter-spacing: 4px;

            color: var(--gold-light);

            margin-bottom: 8px;

        }


        /* =========================================================
           ORGANISATION
        ========================================================== */

        .organization {

            font-size: 26px;

            line-height: 1.12;

            font-weight: 900;

            color: white;

            text-transform: uppercase;

            text-shadow:
                0 2px 3px rgba(0,0,0,.35);

        }


        .organization .ampersand {

            color: var(--gold-light);

            font-size: 19px;

        }


        /* =========================================================
           CONTENU RECTO
        ========================================================== */

        .front-main {

            position: relative;

            z-index: 10;

            display: flex;

            gap: 38px;

            padding: 27px 35px;

        }


        /* =========================================================
           PHOTO
        ========================================================== */

        .photo-container {

            width: 230px;

            height: 290px;

            flex-shrink: 0;

            padding: 6px;

            background:
                linear-gradient(
                    135deg,
                    var(--gold-light),
                    var(--gold),
                    #8e6818
                );

            border-radius: 17px;

            box-shadow:
                0 7px 18px rgba(0,0,0,.35);

        }


        .member-photo {

            width: 100%;

            height: 100%;

            object-fit: cover;

            border-radius: 11px;

            border: 2px solid white;

            display: block;

        }


        .photo-placeholder {

            width: 100%;

            height: 100%;

            border-radius: 11px;

            background: #f4f4f4;

            color: var(--green);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 75px;

        }


        /* =========================================================
           DETAILS MEMBRE
        ========================================================== */

        .member-details {

            flex: 1;

            padding-top: 4px;

        }


        /* =========================================================
           NOM
        ========================================================== */

        .member-name {

            font-size: 38px;

            line-height: 1.05;

            font-weight: 900;

            color: white;

            text-transform: uppercase;

            letter-spacing: 1px;

            padding-bottom: 12px;

            border-bottom:
                2px solid var(--gold);

            text-shadow:
                0 3px 4px rgba(0,0,0,.35);

        }


        /* =========================================================
           PROFESSION
        ========================================================== */

        .profession {

            font-size: 28px;

            font-weight: 500;

            color: var(--gold-light);

            text-align: right;

            margin-top: 8px;

            margin-bottom: 22px;

        }


        /* =========================================================
           LIGNES INFORMATIONS
        ========================================================== */

        .info-line {

            min-height: 52px;

            display: flex;

            align-items: center;

            border-top:
                1px solid rgba(220,193,93,.35);

            color: white;

        }


        .info-line:last-of-type {

            border-bottom:
                1px solid rgba(220,193,93,.35);

        }


        .info-label {

            width: 190px;

            font-size: 17px;

            font-weight: 900;

            color: white;

        }


        .info-value {

            flex: 1;

            font-size: 20px;

            font-weight: 700;

            color: white;

        }


        /* =========================================================
           NUMERO CARTE
        ========================================================== */

        .card-number {

            display: inline-flex;

            align-items: center;

            gap: 9px;

            margin-top: 20px;

            padding: 9px 20px;

            border-radius: 5px;

            background:

                linear-gradient(
                    90deg,
                    #c49a32,
                    #e1bf52,
                    #b18725
                );

            color: #132719;

            font-size: 18px;

            font-weight: 900;

            letter-spacing: 1.5px;

            box-shadow:
                0 4px 12px rgba(0,0,0,.25);

        }


        .card-number i {

            color: #132719;

        }


        /* =========================================================
           FOOTER RECTO
        ========================================================== */

        .front-footer {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 18px;

            height: 55px;

            z-index: 20;

            display: flex;

            align-items: center;

            justify-content: center;

            background:

                linear-gradient(
                    90deg,
                    #b98921,
                    #e1c04e 50%,
                    #a77a1d
                );

            color: #102318;

            font-size: 21px;

            font-weight: 900;

            letter-spacing: 4px;

            text-transform: uppercase;

            border-top:
                2px solid #f0d879;

            border-bottom:
                2px solid #8b6518;

        }


        /* =========================================================
           =========================================================
                            VERSO
           =========================================================
        ========================================================== */


        .back-header {

            position: relative;

            z-index: 10;

            height: 125px;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            background:

                linear-gradient(
                    110deg,
                    #012c1c,
                    #075b36,
                    #012c1c
                );

            border-bottom:
                3px solid var(--gold);

        }


        /* =========================================================
           LOGO VERSO
        ========================================================== */

        .back-logo {

            position: absolute;

            left: 32px;

            top: 18px;

        }


        /* =========================================================
           TITRE VERSO
        ========================================================== */

        .back-title {

            font-size: 29px;

            color: white;

            font-weight: 900;

            letter-spacing: 2px;

            text-transform: uppercase;

        }


        .back-subtitle {

            margin-top: 7px;

            font-size: 14px;

            color: var(--gold-light);

            font-weight: 800;

            letter-spacing: 3px;

        }


        /* =========================================================
           CORPS VERSO
        ========================================================== */

        .back-main {

            position: relative;

            z-index: 10;

            display: flex;

            align-items: center;

            gap: 45px;

            padding: 32px 45px;

        }


        /* =========================================================
           SECURITE
        ========================================================== */

        .security {

            flex: 1;

            color: white;

        }


        .security-title {

            display: flex;

            align-items: center;

            gap: 10px;

            color: var(--gold-light);

            font-size: 23px;

            font-weight: 900;

            margin-bottom: 20px;

        }


        .security-title i {

            font-size: 29px;

        }


        .security-text {

            font-size: 16px;

            line-height: 1.55;

            color: rgba(255,255,255,.88);

            margin-bottom: 14px;

        }


        /* =========================================================
           VERIFICATION
        ========================================================== */

        .verification-box {

            margin-top: 20px;

            padding: 13px 17px;

            border-left:
                4px solid var(--gold);

            background:
                rgba(255,255,255,.06);

            color: white;

            font-size: 14px;

            line-height: 1.4;

        }


        .verification-box strong {

            color: var(--gold-light);

        }


        /* =========================================================
           DATES
        ========================================================== */

       .dates {
            display: flex;

            gap: 5px;

            margin-top: 10px;

            position: relative;

            z-index: 30;

            transform: translateY(-8px);
        }


        .date-box {

            min-width: 145px;

            padding: 10px 14px;

            border:
                1px solid
                rgba(216,194,123,.45);

            background:
                rgba(255,255,255,.05);

            border-radius: 5px;

        }


        .date-label {

            color: var(--gold-light);

            font-size: 10px;

            font-weight: 900;

            text-transform: uppercase;

            letter-spacing: 1px;

        }


        .date-value {

            margin-top: 4px;

            color: white;

            font-size: 17px;

            font-weight: 900;

        }


        /* =========================================================
           QR CODE
        ========================================================== */

        .qr-area {

            width: 205px;

            flex-shrink: 0;

            display: flex;

            flex-direction: column;

            align-items: center;

        }


        .qr-container {

            width: 175px;

            height: 175px;

            padding: 10px;

            background: white;

            border-radius: 8px;

            border: 4px solid var(--gold);

            box-shadow:
                0 8px 20px rgba(0,0,0,.30);

        }


        .qr-container svg {

            width: 100%;

            height: 100%;

            display: block;

        }


        .qr-label {

            margin-top: 11px;

            color: var(--gold-light);

            font-size: 12px;

            font-weight: 900;

            letter-spacing: 1.5px;

            text-align: center;

            text-transform: uppercase;

        }


        /* =========================================================
           FOOTER VERSO
        ========================================================== */

        .back-footer {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 18px;

            height: 48px;

            z-index: 20;

            display: flex;

            justify-content: center;

            align-items: center;

            background:

                linear-gradient(
                    90deg,
                    #b98921,
                    #e1c04e 50%,
                    #a77a1d
                );

            color: #102318;

            font-size: 13px;

            font-weight: 900;

            letter-spacing: 2px;

            text-transform: uppercase;

        }


        /* =========================================================
           IMPRESSION
        ========================================================== */

        @media print {

            @page {

                size: 85.60mm 53.98mm;

                margin: 0;

            }


            html,
            body {

                width: 85.60mm;

                margin: 0 !important;

                padding: 0 !important;

                background: white !important;

            }


            body {

                -webkit-print-color-adjust:
                    exact !important;

                print-color-adjust:
                    exact !important;

            }


            .no-print {

                display: none !important;

            }


            .page-container {

                width: 85.60mm;

                padding: 0 !important;

                margin: 0 !important;

                min-height: 0;

            }


            .cards-container {

                display: block;

                width: 85.60mm;

                padding: 0;

                margin: 0;

            }


            .print-card-wrapper {

                width: 85.60mm;

                height: 53.98mm;

                overflow: hidden;

                page-break-inside: avoid;

                break-inside: avoid;

            }


            .recto-wrapper {

                page-break-after: always;

                break-after: page;

            }


            .verso-wrapper {

                page-break-after: auto;

            }


            .uneac-card {

                width: 850px !important;

                height: 536px !important;

                max-width: none !important;

                border-radius: 0 !important;

                box-shadow: none !important;

                transform:
                    scale(0.3802352941) !important;

                transform-origin:
                    top left !important;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media screen and (max-width: 900px) {

            .cards-container {

                overflow-x: auto;

                align-items: flex-start;

            }

        }



    </style>

</head>


<body>


<div class="page-container">


    <!-- =========================================================
         BOUTONS
    ========================================================== -->

    <div class="actions no-print">


        <a
            href="{{ route('cards.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour

        </a>


        <button
            type="button"
            id="btnEnregistrerImage"
            class="btn btn-primary"
            onclick="enregistrerCarteImage()"
        >

            <i class="bi bi-image me-1"></i>

            Enregistrer en image

        </button>


        <button
            type="button"
            class="btn btn-success"
            onclick="window.print()"
        >

            <i class="bi bi-printer me-1"></i>

            Imprimer

        </button>

    </div>



    <!-- =========================================================
         CARTES
    ========================================================== -->

    <div class="cards-container">


        <!-- =====================================================
             RECTO
        ====================================================== -->

        <div class="print-card-wrapper recto-wrapper">


            <div
                class="uneac-card"
                id="carte-recto"
            >


                <!-- =================================================
                     TEXTURE
                ================================================== -->

                <div class="background-pattern"></div>


                <!-- =================================================
                     FILIGRANES ARTISTIQUES
                ================================================== -->

                <div class="art-watermarks">


                    <!-- Appareil photo -->

                    <div class="art-watermark wm-camera">

                        <i class="bi bi-camera"></i>

                    </div>


                    <!-- Caméra -->

                    <div class="art-watermark wm-camera-video">

                        <i class="bi bi-camera-reels"></i>

                    </div>


                    <!-- Livre -->

                    <div class="art-watermark wm-book">

                        <i class="bi bi-book-half"></i>

                    </div>


                    <!-- Plume -->

                    <div class="art-watermark wm-feather">

                        <i class="bi bi-feather"></i>

                    </div>


                    <!-- Palette -->

                    <div class="art-watermark wm-palette">

                        <i class="bi bi-palette"></i>

                    </div>


                    <!-- Musique -->

                    <div class="art-watermark wm-music">

                        <i class="bi bi-music-note-beamed"></i>

                    </div>


                    <!-- Théâtre -->

                    <div class="art-watermark wm-theatre">

                        <i class="bi bi-mask"></i>

                    </div>


                    <!-- Cinéma -->

                    <div class="art-watermark wm-film">

                        <i class="bi bi-film"></i>

                    </div>


                    <!-- Microphone -->

                    <div class="art-watermark wm-mic">

                        <i class="bi bi-mic"></i>

                    </div>


                </div>



                <!-- =================================================
                     DECORATION
                ================================================== -->

                <div class="gold-decoration"></div>



                <!-- =================================================
                     HEADER
                ================================================== -->

                <div class="front-header">


                    <!-- LOGO -->

                    <div class="front-logo">

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

                    </div>



                    <!-- TITRES -->

                    <div>

                        <div class="country">

                            RÉPUBLIQUE DU CONGO

                        </div>


                        <div class="organization">

                            UNION NATIONALE DES ÉCRIVAINS

                            <br>

                            <span class="ampersand">
                                &
                            </span>

                            ARTISTES CONGOLAIS

                        </div>

                    </div>


                </div>



                <!-- =================================================
                     CONTENU RECTO
                ================================================== -->

                <div class="front-main">


                    <!-- PHOTO -->

                    <div class="photo-container">

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

                    </div>



                    <!-- INFORMATIONS -->

                    <div class="member-details">


                        <!-- NOM -->

                        <div class="member-name">

                            {{ $card->member->nom }}
                            {{ $card->member->postnom }}
                            {{ $card->member->prenom }}

                        </div>



                        <!-- PROFESSION -->

                        <div class="profession">

                            {{ $card->member->profession_artistique ?: 'Profession non renseignée' }}

                        </div>



                        <!-- FÉDÉRATION -->

                        <div class="info-line">

                            <div class="info-label">

                                Fédération

                            </div>

                            <div class="info-value">

                                {{ $card->member->federation?->sigle
                                    ?: $card->member->federation?->nom
                                    ?: 'Non renseignée' }}

                            </div>

                        </div>



                        <!-- CATÉGORIE -->

                        <div class="info-line">

                            <div class="info-label">

                                Catégorie

                            </div>

                            <div class="info-value">

                                {{ $card->member->category?->nom
                                    ?: 'Non renseignée' }}

                            </div>

                        </div>



                        <!-- NUMÉRO MEMBRE -->

                        <div class="info-line">

                            <div class="info-label">

                                Numéro membre

                            </div>

                            <div class="info-value">

                                {{ $card->member->numero_membre }}

                            </div>

                        </div>



                        <!-- NUMÉRO CARTE -->

                        <div class="card-number">

                            <i class="bi bi-person-vcard-fill"></i>

                            {{ $card->numero_carte }}

                        </div>


                    </div>


                </div>



                <!-- =================================================
                     FOOTER RECTO
                ================================================== -->

                <div class="front-footer">

                    CARTE PROFESSIONNELLE

                </div>


            </div>

        </div>



        <!-- =====================================================
             VERSO
        ====================================================== -->

        <div class="print-card-wrapper verso-wrapper">


            <div
                class="uneac-card"
                id="carte-verso"
            >


                <!-- =================================================
                     TEXTURE
                ================================================== -->

                <div class="background-pattern"></div>



                <!-- =================================================
                     FILIGRANES ARTISTIQUES
                ================================================== -->

                <div class="art-watermarks">


                    <div class="art-watermark wm-camera">

                        <i class="bi bi-camera"></i>

                    </div>


                    <div class="art-watermark wm-camera-video">

                        <i class="bi bi-camera-reels"></i>

                    </div>


                    <div class="art-watermark wm-book">

                        <i class="bi bi-book-half"></i>

                    </div>


                    <div class="art-watermark wm-feather">

                        <i class="bi bi-feather"></i>

                    </div>


                    <div class="art-watermark wm-palette">

                        <i class="bi bi-palette"></i>

                    </div>


                    <div class="art-watermark wm-music">

                        <i class="bi bi-music-note-beamed"></i>

                    </div>


                    <div class="art-watermark wm-theatre">

                        <i class="bi bi-mask"></i>

                    </div>


                    <div class="art-watermark wm-film">

                        <i class="bi bi-film"></i>

                    </div>


                    <div class="art-watermark wm-mic">

                        <i class="bi bi-mic"></i>

                    </div>


                </div>



                <!-- =================================================
                     DECORATION
                ================================================== -->

                <div class="gold-decoration"></div>



                <!-- =================================================
                     HEADER VERSO
                ================================================== -->

                <div class="back-header">


                    <!-- LOGO -->

                    <div class="back-logo">

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

                    </div>



                    <!-- TITRE -->

                    <div>

                        <div class="back-title">

                            CARTE PROFESSIONNELLE

                        </div>


                        <div class="back-subtitle">

                            IDENTITÉ • CULTURE • ART

                        </div>

                    </div>


                </div>



                <!-- =================================================
                     CONTENU VERSO
                ================================================== -->

                <div class="back-main">


                    <!-- =================================================
                         TEXTE
                    ================================================== -->

                    <div class="security">


                        <div class="security-title">

                            <i class="bi bi-shield-check"></i>

                            VÉRIFICATION DE LA CARTE

                        </div>



                        <div class="security-text">

                            Cette carte est personnelle et
                            appartient exclusivement à son
                            titulaire.

                        </div>


                        <div class="security-text">

                            Elle permet d'identifier son titulaire
                            en qualité de membre de l'Union
                            Nationale des Écrivains et Artistes
                            Congolais.

                        </div>



                        <!-- VERIFICATION -->

                        <div class="verification-box">

                            <strong>
                                Authentification :
                            </strong>

                            Scannez le QR Code afin de vérifier
                            l'identité du membre, le numéro de
                            carte et la validité de cette carte.

                        </div>



                        <!-- DATES -->

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



                    <!-- =================================================
                         QR CODE
                    ================================================== -->

                    <div class="qr-area">


                        <div class="qr-container">

                            {!! QrCode::size(150)
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



                <!-- =================================================
                     FOOTER VERSO
                ================================================== -->

                <div class="back-footer">

                    UNION NATIONALE DES ÉCRIVAINS
                    ET ARTISTES CONGOLAIS

                </div>


            </div>

        </div>


    </div>

</div>



<!-- =============================================================
     HTML2CANVAS
============================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js">
</script>


<script>


/* =============================================================
   ENREGISTRER RECTO + VERSO
============================================================= */

async function enregistrerCarteImage() {


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
            'La bibliothèque html2canvas n’est pas disponible.'
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

                    backgroundColor: null,

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

                    backgroundColor: null,

                    logging: false,

                    imageTimeout: 15000,

                    width: 850,

                    height: 536,

                    windowWidth: 850,

                    windowHeight: 536

                }
            );



        /* =====================================================
           TELECHARGER RECTO
        ====================================================== */

        telechargerCanvas(
            canvasRecto,
            'UNEAC-RECTO-{{ $card->numero_carte }}.png'
        );


        await attendre(800);



        /* =====================================================
           TELECHARGER VERSO
        ====================================================== */

        telechargerCanvas(
            canvasVerso,
            'UNEAC-VERSO-{{ $card->numero_carte }}.png'
        );


    } catch (error) {


        console.error(
            'Erreur génération carte :',
            error
        );


        alert(
            'Une erreur est survenue pendant la génération.'
        );


    } finally {


        bouton.disabled = false;


        bouton.innerHTML =
            '<i class="bi bi-image me-1"></i>' +
            'Enregistrer en image';

    }

}



/* =============================================================
   ATTENDRE LES IMAGES
============================================================= */

function attendreImages(element) {


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

                        image.onload = resolve;

                        image.onerror = resolve;

                    }
                );

            }
        )

    );

}



/* =============================================================
   ATTENDRE
============================================================= */

function attendre(milliseconds) {

    return new Promise(
        resolve =>
            setTimeout(
                resolve,
                milliseconds
            )
    );

}



/* =============================================================
   TELECHARGER CANVAS
============================================================= */

function telechargerCanvas(
    canvas,
    nomFichier
) {


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


</body>

</html>
