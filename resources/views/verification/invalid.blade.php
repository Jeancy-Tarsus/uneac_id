<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Carte invalide — UNEAC</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        :root {
            --uneac-green: #087f3f;
            --uneac-green-dark: #045c2d;
            --uneac-green-light: #eaf6ef;
            --uneac-gold: #c5a04a;
            --uneac-border: #e4ebe6;
            --text-dark: #202428;
            --text-muted: #737b80;
            --danger: #dc3545;
            --danger-light: #fdecec;
            --danger-border: #f2bcbc;
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

            padding: 35px 15px;

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

            padding: 25px 115px;

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
           CONTENU CENTRAL
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
           STATUT INVALIDE
        ====================================================== */

        .status-box {

            border-radius: 16px;

            padding: 20px;

            text-align: center;

            margin-bottom: 25px;

            background: var(--danger-light);

            border:
                1px solid var(--danger-border);

            color: #a12828;
        }


        .status-icon-wrapper {

            width: 52px;

            height: 52px;

            margin:
                0 auto 10px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 27px;

            background: var(--danger);

            color: #ffffff;

            box-shadow:
                0 5px 12px rgba(220,53,69,.20);
        }


        .status-title {

            font-size: 19px;

            font-weight: 900;

            letter-spacing: .5px;
        }


        .status-description {

            font-size: 13px;

            margin:
                6px 0 0;

            line-height: 1.5;
        }


        /* =====================================================
           BLOC INFORMATION
        ====================================================== */

        .information-box {

            background: #f8faf9;

            border:
                1px solid var(--uneac-border);

            border-radius: 15px;

            padding: 20px;

            margin-top: 20px;
        }


        .information-title {

            font-size: 15px;

            font-weight: 800;

            color:
                var(--uneac-green-dark);

            margin-bottom: 10px;
        }


        .information-text {

            font-size: 12px;

            color: var(--text-muted);

            line-height: 1.6;

            margin: 0;
        }


        /* =====================================================
           SÉCURITÉ
        ====================================================== */

        .security-box {

            margin-top: 20px;

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
           MOBILE
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
                    17px 12px;
            }


            .status-title {

                font-size: 17px;
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


            {{-- STATUT --}}

            <div class="status-box">


                <div class="status-icon-wrapper">

                    <i class="bi bi-x-lg"></i>

                </div>


                <div class="status-title">

                    CARTE NON VALIDE

                </div>


                <p class="status-description">

                    Cette carte ne peut pas être vérifiée.
                    L'identifiant QR fourni est inexistant
                    ou invalide.

                </p>


            </div>


            {{-- INFORMATION --}}

            <div class="information-box">

                <div class="information-title">

                    <i class="bi bi-info-circle-fill me-1"></i>

                    Pourquoi cette carte est-elle invalide ?

                </div>


                <p class="information-text">

                    Le QR Code utilisé ne correspond à aucune carte
                    enregistrée dans le système d'identification
                    des membres de l'UNEAC.

                </p>

            </div>


            {{-- SÉCURITÉ --}}

            <div class="security-box">

                <i class="bi bi-shield-check"></i>


                <div class="security-title">

                    Vérification sécurisée

                </div>


                <p class="security-text">

                    Utilisez uniquement les QR Codes présents
                    sur les cartes officielles délivrées par l'UNEAC.

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
