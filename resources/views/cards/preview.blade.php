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

        body {
            background: #f1f3f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-container {
            min-height: 100vh;
            padding: 40px 20px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }


        /* ==========================================
           CARTE
        ========================================== */

        .uneac-card {

            width: 850px;
            max-width: 100%;

            aspect-ratio: 1.586 / 1;

            background: white;

            border-radius: 18px;

            overflow: hidden;

            position: relative;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);

            border: 1px solid #dee2e6;
        }


        /* ==========================================
           RECTO
        ========================================== */

        .card-front {

            background: linear-gradient(
                135deg,
                #ffffff 0%,
                #f8fdf9 65%,
                #e8f5ec 100%
            );

        }


        .card-top {

            height: 115px;

            background: #087f3f;

            color: white;

            padding: 18px 30px;

            display: flex;

            align-items: center;

            gap: 20px;
        }


        .logo-box {

            width: 75px;
            height: 75px;

            background: white;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;

            flex-shrink: 0;
        }


        .logo-box img {

            width: 65px;
            height: 65px;

            object-fit: contain;
        }


        .logo-placeholder {

            color: #087f3f;

            font-weight: 800;

            font-size: 18px;
        }


        .header-text {

            line-height: 1.25;
        }


        .header-country {

            font-size: 15px;

            font-weight: 600;

            letter-spacing: 1px;
        }


        .header-title {

            font-size: 20px;

            font-weight: 800;

            text-transform: uppercase;
        }


        .header-subtitle {

            font-size: 13px;

            opacity: .9;
        }


        .front-body {

            padding: 28px 32px;

            display: flex;

            gap: 30px;
        }


        .member-photo {

            width: 190px;

            height: 225px;

            border-radius: 10px;

            object-fit: cover;

            border: 5px solid white;

            box-shadow: 0 3px 12px rgba(0,0,0,.15);

            background: #e9ecef;

            flex-shrink: 0;
        }


        .photo-placeholder {

            width: 190px;
            height: 225px;

            border-radius: 10px;

            background: #e9ecef;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 5px solid white;

            box-shadow: 0 3px 12px rgba(0,0,0,.15);

            flex-shrink: 0;
        }


        .photo-placeholder i {

            font-size: 80px;

            color: #adb5bd;
        }


        .member-info {

            flex: 1;
        }


        .card-label {

            font-size: 11px;

            color: #6c757d;

            text-transform: uppercase;

            font-weight: 700;

            letter-spacing: .5px;

            margin-bottom: 3px;
        }


        .member-name {

            font-size: 28px;

            font-weight: 800;

            color: #212529;

            text-transform: uppercase;

            margin-bottom: 20px;
        }


        .info-grid {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 14px 25px;
        }


        .info-value {

            font-size: 15px;

            font-weight: 700;

            color: #212529;
        }


        .member-number {

            margin-top: 22px;

            display: inline-block;

            background: #087f3f;

            color: white;

            padding: 9px 18px;

            border-radius: 6px;

            font-size: 16px;

            font-weight: 800;

            letter-spacing: 1px;
        }


        .card-footer-line {

            position: absolute;

            bottom: 0;

            left: 0;

            right: 0;

            height: 12px;

            background: #087f3f;
        }


        /* ==========================================
           VERSO
        ========================================== */

        .card-back {

            background:
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #f3faf5 100%
                );

            display: flex;

            flex-direction: column;
        }


        .back-header {

            background: #087f3f;

            color: white;

            padding: 20px 30px;

            text-align: center;
        }


        .back-header h2 {

            margin: 0;

            font-size: 24px;

            font-weight: 800;

            letter-spacing: 1px;
        }


        .back-header p {

            margin: 4px 0 0;

            font-size: 12px;
        }


        .back-content {

            flex: 1;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 25px 40px;

            gap: 30px;
        }


        .security-text {

            flex: 1;
        }


        .security-title {

            font-size: 17px;

            font-weight: 800;

            color: #087f3f;

            margin-bottom: 12px;
        }


        .security-text p {

            font-size: 13px;

            line-height: 1.6;

            color: #495057;

            margin-bottom: 12px;
        }


        .dates {

            margin-top: 20px;

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 15px;
        }


        .date-box {

            border: 1px solid #ced4da;

            border-radius: 8px;

            padding: 10px;

            background: white;
        }


        .date-label {

            font-size: 10px;

            color: #6c757d;

            text-transform: uppercase;

            font-weight: 700;
        }


        .date-value {

            font-size: 14px;

            font-weight: 800;

            margin-top: 3px;
        }


        .qr-section {

            width: 220px;

            text-align: center;

            flex-shrink: 0;
        }


        .qr-box {

            background: white;

            padding: 12px;

            border: 1px solid #dee2e6;

            border-radius: 10px;

            display: inline-block;
        }


        .qr-box svg {

            display: block;
        }


        .qr-text {

            font-size: 11px;

            color: #6c757d;

            margin-top: 10px;

            line-height: 1.4;
        }


        .back-footer {

            padding: 10px 30px;

            background: #087f3f;

            color: white;

            text-align: center;

            font-size: 11px;
        }


        /* ==========================================
           BOUTONS
        ========================================== */

        .actions {

            text-align: center;

            margin-bottom: 35px;
        }


        /* ==========================================
           RESPONSIVE
        ========================================== */

        @media (max-width: 700px) {

            .uneac-card {

                aspect-ratio: auto;

                min-height: 390px;

            }

            .card-top {

                height: 85px;

                padding: 12px 18px;
            }

            .logo-box {

                width: 55px;
                height: 55px;
            }

            .logo-box img {

                width: 48px;
                height: 48px;
            }

            .header-title {

                font-size: 14px;
            }

            .header-country {

                font-size: 10px;
            }

            .header-subtitle {

                font-size: 9px;
            }

            .front-body {

                padding: 18px;

                gap: 15px;
            }

            .member-photo,
            .photo-placeholder {

                width: 110px;
                height: 135px;
            }

            .photo-placeholder i {

                font-size: 50px;
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

                font-size: 12px;
            }

            .member-number {

                font-size: 12px;

                padding: 7px 10px;
            }

            .back-content {

                padding: 20px;

                flex-direction: column;

                text-align: center;
            }

            .dates {

                text-align: left;
            }

            .qr-section {

                width: auto;
            }

        }


        /* ==========================================
           IMPRESSION
        ========================================== */

        @media print {

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

                border-radius: 0;

                box-shadow: none;

                margin: 0 auto 10mm;

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


    {{-- ================================================= --}}
    {{-- BOUTONS --}}
    {{-- ================================================= --}}

    <div class="actions no-print">

        <a href="{{ route('cards.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Retour aux cartes

        </a>

        <button type="button"
                onclick="window.print()"
                class="btn btn-primary">

            <i class="bi bi-printer me-1"></i>

            Imprimer la carte

        </button>

    </div>



    <div class="cards-container">


        {{-- ================================================= --}}
        {{-- RECTO --}}
        {{-- ================================================= --}}

        <div class="uneac-card card-front">


            {{-- EN-TÊTE --}}

            <div class="card-top">


                <div class="logo-box">

                    {{--

                    Place ton logo ici :

                    public/images/uneac-logo.png

                    --}}

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
                        UNION NATIONALE DES ÉCRIVAINS ET ARTISTES CONGOLAIS
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
                        Carte de membre
                    </div>


                    <div class="member-name">

                        {{ $card->member->nom }}

                        {{ $card->member->postnom }}

                        {{ $card->member->prenom }}

                    </div>


                    <div class="info-grid">


                        <div>

                            <div class="card-label">
                                Profession artistique
                            </div>

                            <div class="info-value">

                                {{ $card->member->profession_artistique ?? '—' }}

                            </div>

                        </div>


                        <div>

                            <div class="card-label">
                                Catégorie
                            </div>

                            <div class="info-value">

                                {{ $card->member->category->nom ?? '—' }}

                            </div>

                        </div>


                        <div>

                            <div class="card-label">
                                Fédération
                            </div>

                            <div class="info-value">

                                {{ $card->member->federation->sigle
                                    ?? $card->member->federation->nom
                                    ?? '—' }}

                            </div>

                        </div>


                        <div>

                            <div class="card-label">
                                N° membre
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



        {{-- ================================================= --}}
        {{-- VERSO --}}
        {{-- ================================================= --}}

        <div class="uneac-card card-back">


            {{-- EN-TÊTE --}}

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

                        <i class="bi bi-shield-check me-1"></i>

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

                        {!! QrCode::size(180)
                            ->margin(1)
                            ->generate(
                                route(
                                    'verification.show',
                                    $card->qr_token
                                )
                            )
                        !!}

                    </div>


                    <div class="qr-text">

                        <strong>
                            Scanner pour vérifier
                        </strong>

                        <br>

                        l'authenticité de la carte

                    </div>

                </div>


            </div>


            {{-- PIED --}}

            <div class="back-footer">

                UNION NATIONALE DES ÉCRIVAINS ET ARTISTES CONGOLAIS

            </div>

        </div>

    </div>

</div>


</body>

</html>
