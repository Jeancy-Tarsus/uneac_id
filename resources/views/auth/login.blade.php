<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Connexion — UNEAC ID</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>
       :root {
    --uneac-green: #087f3f;
    --uneac-green-dark: #045c2d;
    --uneac-green-light: #eaf6ef;
    --uneac-gold: #c5a04a;
    --uneac-gold-light: #e2cc8b;
    --uneac-white: #ffffff;
    --uneac-text: #26332c;
}

/* =========================================================
   BASE
========================================================= */

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: "Segoe UI", Arial, sans-serif;
    color: var(--uneac-text);

    background:
        radial-gradient(
            circle at 10% 20%,
            rgba(197, 160, 74, .08),
            transparent 28%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(8, 127, 63, .10),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #f8fcfa 0%,
            #edf7f1 100%
        );

    overflow-x: hidden;
}


/* =========================================================
   FILIGRANES CULTURELS
========================================================= */

.cultural-watermarks {
    position: fixed;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
    z-index: 0;
}

.watermark {
    position: absolute;
    color: var(--uneac-green);
    opacity: .045;
    font-size: 110px;
}

.watermark.gold {
    color: var(--uneac-gold);
    opacity: .055;
}


/* Livre */

.wm-book {
    top: 7%;
    left: 4%;
    transform: rotate(-15deg);
    font-size: 130px;
}


/* Plume */

.wm-feather {
    top: 8%;
    right: 7%;
    transform: rotate(20deg);
    font-size: 125px;
}


/* Musique */

.wm-music {
    bottom: 9%;
    left: 7%;
    transform: rotate(-12deg);
    font-size: 120px;
}


/* Théâtre */

.wm-theater {
    bottom: 10%;
    right: 5%;
    transform: rotate(12deg);
    font-size: 130px;
}


/* Arts plastiques */

.wm-palette {
    top: 45%;
    left: -15px;
    transform: rotate(-20deg);
    font-size: 100px;
}


/* Photographie */

.wm-camera {
    top: 47%;
    right: 0;
    transform: rotate(15deg);
    font-size: 95px;
}


/* Écriture */

.wm-pen {
    top: 25%;
    left: 42%;
    transform: rotate(-25deg);
    font-size: 75px;
}


/* Danse / spectacle */

.wm-dance {
    bottom: 25%;
    right: 42%;
    transform: rotate(15deg);
    font-size: 70px;
}


/* =========================================================
   CERCLES DÉCORATIFS
========================================================= */

.decor-circle {
    position: absolute;
    border: 1px solid var(--uneac-green);
    border-radius: 50%;
    opacity: .06;
}

.circle-one {
    width: 350px;
    height: 350px;
    top: -180px;
    left: -100px;
}

.circle-two {
    width: 450px;
    height: 450px;
    bottom: -250px;
    right: -150px;
}

.circle-three {
    width: 170px;
    height: 170px;
    top: 30%;
    right: 15%;
    border-color: var(--uneac-gold);
}


/* =========================================================
   STRUCTURE PRINCIPALE
========================================================= */

.login-wrapper {
    position: relative;
    z-index: 2;

    min-height: 100vh;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 30px 20px;
}

.login-container {
    width: 100%;
    max-width: 900px;
}


/* =========================================================
   CARTE PRINCIPALE
========================================================= */

.login-card {
    position: relative;
    overflow: hidden;

    background: rgba(255, 255, 255, .98);

    border-radius: 20px;

    box-shadow:
        0 20px 55px rgba(4, 92, 45, .12),
        0 6px 20px rgba(0, 0, 0, .04);

    border: 1px solid rgba(8, 127, 63, .08);
}


/* Ligne supérieure verte + or */

.login-card::before {
    content: "";

    position: absolute;

    top: 0;
    left: 0;
    right: 0;

    height: 4px;

    background: linear-gradient(
        90deg,
        var(--uneac-green-dark),
        var(--uneac-green),
        var(--uneac-gold),
        var(--uneac-green)
    );

    z-index: 10;
}


/* =========================================================
   PANNEAU GAUCHE
========================================================= */

.brand-panel {
    position: relative;

    min-height: 520px;

    padding: 40px 38px;

    background:
        linear-gradient(
            145deg,
            rgba(4, 92, 45, .98),
            rgba(8, 127, 63, .96)
        );

    color: white;

    display: flex;
    flex-direction: column;
    justify-content: center;

    overflow: hidden;
}


/* Grand cercle décoratif */

.brand-panel::before {
    content: "";

    position: absolute;

    width: 420px;
    height: 420px;

    border: 1px solid rgba(255, 255, 255, .09);

    border-radius: 50%;

    top: -230px;
    left: -160px;
}


/* Cercle doré */

.brand-panel::after {
    content: "";

    position: absolute;

    width: 500px;
    height: 500px;

    border: 1px solid rgba(197, 160, 74, .17);

    border-radius: 50%;

    bottom: -300px;
    right: -180px;
}


/* Contenu */

.brand-content {
    position: relative;
    z-index: 5;
}


/* =========================================================
   LOGO
========================================================= */

.logo-container {
    width: 105px;
    height: 105px;

    background: white;

    border: 3px solid var(--uneac-gold);

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 22px;

    box-shadow:
        0 10px 25px rgba(0, 0, 0, .14);
}

.logo-container img {
    width: 82px;
    height: 82px;

    max-width: 82px;
    max-height: 82px;

    object-fit: contain;

    display: block;
}

.logo-placeholder {
    color: var(--uneac-green);

    font-weight: 900;

    font-size: 22px;
}


/* =========================================================
   TITRE UNEAC ID
========================================================= */

.brand-title {
    font-size: 36px;

    font-weight: 800;

    letter-spacing: -.5px;

    margin-bottom: 7px;
}

.brand-subtitle {
    color: var(--uneac-gold-light);

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 1.8px;

    text-transform: uppercase;

    margin-bottom: 20px;
}


/* Petite ligne dorée */

.brand-line {
    width: 55px;
    height: 3px;

    background: var(--uneac-gold);

    margin-bottom: 20px;

    border-radius: 10px;
}


/* =========================================================
   DESCRIPTION
========================================================= */

.brand-description {
    max-width: 390px;

    font-size: 14px;

    line-height: 1.7;

    color: rgba(255, 255, 255, .82);

    margin-bottom: 25px;
}


/* =========================================================
   VALEURS
========================================================= */

.brand-values {
    display: flex;

    gap: 8px;

    flex-wrap: wrap;
}

.brand-value {
    border: 1px solid rgba(255, 255, 255, .17);

    background: rgba(255, 255, 255, .07);

    border-radius: 50px;

    padding: 7px 12px;

    font-size: 11px;

    color: rgba(255, 255, 255, .9);
}

.brand-value i {
    color: var(--uneac-gold-light);

    margin-right: 4px;
}


/* =========================================================
   FILIGRANES DU PANNEAU VERT
========================================================= */

.panel-watermark {
    position: absolute;

    color: white;

    opacity: .04;

    z-index: 1;

    pointer-events: none;
}

.panel-book {
    right: 15px;
    top: 60px;

    font-size: 145px;

    transform: rotate(-12deg);
}

.panel-music {
    left: 15px;
    bottom: 15px;

    font-size: 135px;

    transform: rotate(10deg);
}

.panel-feather {
    right: 45px;
    bottom: 45px;

    font-size: 100px;

    transform: rotate(20deg);
}


/* =========================================================
   PANNEAU FORMULAIRE
========================================================= */

.form-panel {
    min-height: 520px;

    padding: 45px 50px;

    display: flex;
    align-items: center;

    background: #fff;
}

.form-content {
    width: 100%;

    max-width: 390px;

    margin: auto;
}


/* =========================================================
   ICÔNE BIENVENUE
========================================================= */

.welcome-icon {
    width: 52px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: var(--uneac-green-light);

    color: var(--uneac-green);

    font-size: 22px;

    margin-bottom: 18px;
}


/* =========================================================
   TITRE FORMULAIRE
========================================================= */

.form-title {
    font-size: 29px;

    font-weight: 800;

    color: #1d2922;

    margin-bottom: 6px;
}

.form-subtitle {
    font-size: 13px;

    color: #7b847f;

    margin-bottom: 27px;
}


/* =========================================================
   LABELS
========================================================= */

.form-label {
    font-size: 12px;

    font-weight: 700;

    color: #38443d;

    margin-bottom: 8px;
}


/* =========================================================
   INPUTS
========================================================= */

.input-group-custom {
    position: relative;

    margin-bottom: 18px;
}

.input-icon {
    position: absolute;

    left: 16px;
    top: 50%;

    transform: translateY(-50%);

    color: #8b958f;

    font-size: 16px;

    z-index: 5;
}

.form-control-custom {
    height: 51px;

    width: 100%;

    border: 1px solid #dce4df;

    border-radius: 11px;

    padding: 0 46px;

    font-size: 13px;

    color: #26332c;

    background: #fbfdfc;

    outline: none;

    transition: all .2s ease;
}

.form-control-custom:focus {
    border-color: var(--uneac-green);

    background: white;

    box-shadow:
        0 0 0 4px rgba(8, 127, 63, .07);
}

.form-control-custom::placeholder {
    color: #a5ada8;
}


/* =========================================================
   BOUTON AFFICHER MOT DE PASSE
========================================================= */

.password-toggle {
    position: absolute;

    right: 14px;
    top: 50%;

    transform: translateY(-50%);

    border: 0;

    background: transparent;

    color: #8b958f;

    cursor: pointer;

    font-size: 16px;

    z-index: 6;

    padding: 3px;
}

.password-toggle:hover {
    color: var(--uneac-green);
}


/* =========================================================
   OPTIONS
========================================================= */

.form-options {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin: 3px 0 23px;
}

.remember-label {
    font-size: 12px;

    color: #66716b;

    cursor: pointer;
}

.form-check-input {
    border-color: #cbd6cf;

    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--uneac-green);

    border-color: var(--uneac-green);
}

.forgot-link {
    font-size: 12px;

    color: var(--uneac-green);

    text-decoration: none;

    font-weight: 600;
}

.forgot-link:hover {
    color: var(--uneac-green-dark);

    text-decoration: underline;
}


/* =========================================================
   BOUTON CONNEXION
========================================================= */

.btn-login {
    width: 100%;

    height: 52px;

    border: none;

    border-radius: 11px;

    background:
        linear-gradient(
            135deg,
            var(--uneac-green),
            var(--uneac-green-dark)
        );

    color: white;

    font-size: 13px;

    font-weight: 800;

    letter-spacing: .4px;

    box-shadow:
        0 9px 20px rgba(8, 127, 63, .19);

    transition: all .25s ease;
}

.btn-login:hover {
    transform: translateY(-2px);

    box-shadow:
        0 13px 25px rgba(8, 127, 63, .25);

    color: white;
}

.btn-login i {
    margin-right: 6px;
}


/* =========================================================
   NOTE DE SÉCURITÉ
========================================================= */

.security-note {
    margin-top: 24px;

    padding-top: 16px;

    border-top: 1px solid #edf1ee;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    color: #929b96;

    font-size: 10px;
}

.security-note i {
    color: var(--uneac-green);

    font-size: 13px;
}


/* =========================================================
   RESPONSIVE TABLETTE
========================================================= */

@media (max-width: 991.98px) {

    .brand-panel {
        min-height: auto;

        padding: 40px 35px;
    }

    .form-panel {
        min-height: auto;

        padding: 40px 35px;
    }

    .brand-title {
        font-size: 33px;
    }

    .logo-container {
        width: 95px;
        height: 95px;
    }

    .logo-container img {
        width: 75px;
        height: 75px;
    }

}


/* =========================================================
   RESPONSIVE MOBILE
========================================================= */

@media (max-width: 575.98px) {

    .login-wrapper {
        padding: 15px 10px;
    }

    .login-card {
        border-radius: 16px;
    }

    .brand-panel {
        padding: 32px 25px;
    }

    .form-panel {
        padding: 35px 25px;
    }

    .brand-title {
        font-size: 29px;
    }

    .brand-subtitle {
        font-size: 10px;

        letter-spacing: 1.3px;
    }

    .brand-description {
        font-size: 13px;

        line-height: 1.65;
    }

    .form-title {
        font-size: 26px;
    }

    .form-subtitle {
        font-size: 12px;
    }

    .form-options {
        flex-direction: column;

        align-items: flex-start;
    }

    .watermark {
        font-size: 70px;
    }

    .panel-book {
        font-size: 110px;
    }

    .panel-music {
        font-size: 105px;
    }

    .panel-feather {
        font-size: 80px;
    }
}
    </style>
</head>

<body>

    {{-- =========================================================
         FILIGRANES CULTURELS
    ========================================================== --}}
    <div class="cultural-watermarks">

        {{-- Livre --}}
        <i class="bi bi-book watermark wm-book"></i>

        {{-- Plume / écriture --}}
        <i class="bi bi-feather watermark gold wm-feather"></i>

        {{-- Musique --}}
        <i class="bi bi-music-note-beamed watermark wm-music"></i>

        {{-- Théâtre --}}
        <i class="bi bi-mask watermark gold wm-theater"></i>

        {{-- Arts plastiques --}}
        <i class="bi bi-palette watermark wm-palette"></i>

        {{-- Photographie / cinéma --}}
        <i class="bi bi-camera watermark gold wm-camera"></i>

        {{-- Écriture --}}
        <i class="bi bi-pen watermark wm-pen"></i>

        {{-- Danse / spectacle --}}
        <i class="bi bi-person-arms-up watermark gold wm-dance"></i>

        {{-- Cercles --}}
        <div class="decor-circle circle-one"></div>
        <div class="decor-circle circle-two"></div>
        <div class="decor-circle circle-three"></div>

    </div>


    {{-- =========================================================
         LOGIN
    ========================================================== --}}
    <div class="login-wrapper">

        <div class="login-container">

            <div class="login-card">

                <div class="row g-0">

                    {{-- =================================================
                         PARTIE GAUCHE
                    ================================================== --}}
                    <div class="col-lg-6">

                        <div class="brand-panel">

                            {{-- Filigranes internes --}}
                            <i class="bi bi-book panel-watermark panel-book"></i>
                            <i class="bi bi-music-note-beamed panel-watermark panel-music"></i>
                            <i class="bi bi-feather panel-watermark panel-feather"></i>

                            <div class="brand-content">

                                {{-- Logo --}}
                                <div class="logo-container">

                                    @if(file_exists(public_path('images/uneac-logo.png')))

                                        <img src="{{ asset('images/uneac-logo.png') }}"
                                             alt="Logo UNEAC">

                                    @else

                                        <div class="logo-placeholder">
                                            UNEAC
                                        </div>

                                    @endif

                                </div>

                                {{-- Titre --}}
                                <div class="brand-title">
                                    UNEAC ID
                                </div>

                                <div class="brand-subtitle">
                                    Identité • Culture • Art
                                </div>

                                <div class="brand-line"></div>

                                <p class="brand-description">

                                    Plateforme professionnelle de gestion,
                                    d'identification et de suivi des membres
                                    de l'Union Nationale des Écrivains et
                                    Artistes Congolais.

                                </p>

                                {{-- Valeurs --}}
                                <div class="brand-values">

                                    <span class="brand-value">
                                        <i class="bi bi-book"></i>
                                        Littérature
                                    </span>

                                    <span class="brand-value">
                                        <i class="bi bi-music-note-beamed"></i>
                                        Musique
                                    </span>

                                    <span class="brand-value">
                                        <i class="bi bi-palette"></i>
                                        Arts
                                    </span>

                                    <span class="brand-value">
                                        <i class="bi bi-mask"></i>
                                        Théâtre
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         PARTIE DROITE — FORMULAIRE
                    ================================================== --}}
                    <div class="col-lg-6">

                        <div class="form-panel">

                            <div class="form-content">

                                {{-- Icône --}}
                                <div class="welcome-icon">
                                    <i class="bi bi-person-lock"></i>
                                </div>

                                <h1 class="form-title">
                                    Bienvenue
                                </h1>

                                <p class="form-subtitle">
                                    Connectez-vous à votre espace d'administration
                                </p>


                                {{-- Messages --}}
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif


                                {{-- Erreurs --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <div class="fw-bold mb-1">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            Vérifiez les informations saisies.
                                        </div>

                                        <ul class="mb-0 ps-3 small">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                {{-- FORMULAIRE --}}
                                <form method="POST" action="{{ route('login') }}">

                                    @csrf

                                    {{-- Email --}}
                                    <div class="input-group-custom">

                                        <label for="email" class="form-label">
                                            Adresse e-mail
                                        </label>

                                        <div class="position-relative">

                                            <i class="bi bi-envelope input-icon"></i>

                                            <input
                                                id="email"
                                                type="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autofocus
                                                autocomplete="username"
                                                class="form-control-custom"
                                                placeholder="votre@email.com"
                                            >

                                        </div>

                                    </div>


                                    {{-- Mot de passe --}}
                                    <div class="input-group-custom">

                                        <label for="password" class="form-label">
                                            Mot de passe
                                        </label>

                                        <div class="position-relative">

                                            <i class="bi bi-lock input-icon"></i>

                                            <input
                                                id="password"
                                                type="password"
                                                name="password"
                                                required
                                                autocomplete="current-password"
                                                class="form-control-custom"
                                                placeholder="Votre mot de passe"
                                            >

                                            <button
                                                type="button"
                                                class="password-toggle"
                                                id="togglePassword"
                                                aria-label="Afficher le mot de passe"
                                            >
                                                <i class="bi bi-eye" id="eyeIcon"></i>
                                            </button>

                                        </div>

                                    </div>


                                    {{-- Options --}}
                                    <div class="form-options">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="remember"
                                                id="remember"
                                            >

                                            <label
                                                class="form-check-label remember-label"
                                                for="remember"
                                            >
                                                Se souvenir de moi
                                            </label>

                                        </div>


                                        @if (Route::has('password.request'))

                                            <a
                                                href="{{ route('password.request') }}"
                                                class="forgot-link"
                                            >
                                                Mot de passe oublié ?
                                            </a>

                                        @endif

                                    </div>


                                    {{-- Bouton --}}
                                    <button type="submit" class="btn-login">

                                        <i class="bi bi-box-arrow-in-right"></i>

                                        SE CONNECTER

                                    </button>

                                </form>


                                {{-- Sécurité --}}
                                <div class="security-note">

                                    <i class="bi bi-shield-check"></i>

                                    <span>
                                        Accès sécurisé — UNEAC ID
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}
    <script>

        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword) {

            togglePassword.addEventListener('click', function () {

                const type = password.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';

                password.setAttribute('type', type);

                if (type === 'text') {

                    eyeIcon.classList.remove('bi-eye');
                    eyeIcon.classList.add('bi-eye-slash');

                    togglePassword.setAttribute(
                        'aria-label',
                        'Masquer le mot de passe'
                    );

                } else {

                    eyeIcon.classList.remove('bi-eye-slash');
                    eyeIcon.classList.add('bi-eye');

                    togglePassword.setAttribute(
                        'aria-label',
                        'Afficher le mot de passe'
                    );
                }

            });

        }

    </script>

</body>
</html>
