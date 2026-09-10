<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Connexion — UNEAC ID
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

        :root {

            --uneac-green: #087f3f;

            --uneac-green-dark: #045c2d;

            --uneac-green-deep: #034b25;

            --uneac-green-light: #e8f3ed;

            --uneac-gold: #b8943d;

            --uneac-gold-light: #d8c27b;

        }


        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            min-height: 100vh;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #f5f8f6 0%,
                    #ffffff 50%,
                    #edf5f0 100%
                );

            overflow-x: hidden;

        }


        /* =====================================================
           PAGE
        ===================================================== */

        .login-page {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px 20px;

            position: relative;

            overflow: hidden;

        }


        /* =====================================================
           DÉCORATIONS
        ===================================================== */

        .decor {

            position: absolute;

            pointer-events: none;

        }


        .decor-circle-1 {

            width: 500px;

            height: 500px;

            border: 1px solid rgba(8,127,63,.08);

            border-radius: 50%;

            right: -250px;

            top: -180px;

        }


        .decor-circle-2 {

            width: 350px;

            height: 350px;

            border: 1px solid rgba(184,148,61,.10);

            border-radius: 50%;

            left: -180px;

            bottom: -150px;

        }


        .decor-circle-3 {

            width: 260px;

            height: 260px;

            border: 1px solid rgba(8,127,63,.05);

            border-radius: 50%;

            right: 8%;

            bottom: 5%;

        }


        .decor-zigzag {

            position: absolute;

            width: 280px;

            height: 100px;

            opacity: .06;

            background:
                linear-gradient(
                    135deg,
                    transparent 0 18px,
                    var(--uneac-green) 18px 20px,
                    transparent 20px 38px
                );

            background-size: 40px 40px;

            transform: rotate(-10deg);

            right: -40px;

            bottom: 80px;

        }


        /* =====================================================
           CONTENEUR
        ===================================================== */

        .login-wrapper {

            width: 100%;

            max-width: 440px;

            position: relative;

            z-index: 10;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .brand {

            text-align: center;

            margin-bottom: 24px;

        }


        .logo-container {

            width: 100px;

            height: 100px;

            margin: 0 auto 15px;

            background: #ffffff;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 4px solid #ffffff;

            box-shadow:
                0 0 0 2px var(--uneac-gold),
                0 10px 30px rgba(0,0,0,.12);

            overflow: hidden;

        }


        .logo-container img {

            width: 82px;

            height: 82px;

            object-fit: contain;

        }


        .logo-placeholder {

            color: var(--uneac-green);

            font-size: 22px;

            font-weight: 900;

        }


        .brand-title {

            margin: 0;

            font-size: 30px;

            font-weight: 900;

            letter-spacing: 2px;

            color: var(--uneac-green-dark);

        }


        .brand-subtitle {

            margin-top: 5px;

            font-size: 11px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 1.5px;

            color: #77817b;

        }


        /* =====================================================
           CARD LOGIN
        ===================================================== */

        .login-card {

            background: rgba(255,255,255,.97);

            border-radius: 18px;

            border: 1px solid #dce5df;

            box-shadow:
                0 20px 60px rgba(0,0,0,.10);

            overflow: hidden;

            position: relative;

        }


        .login-card::before {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            right: 0;

            height: 5px;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-green-deep),
                    var(--uneac-green),
                    var(--uneac-gold)
                );

        }


        .login-card::after {

            content: "";

            position: absolute;

            inset: 10px;

            border: 1px solid rgba(184,148,61,.10);

            border-radius: 12px;

            pointer-events: none;

        }


        .login-body {

            padding: 38px 38px 32px;

            position: relative;

            z-index: 2;

        }


        /* =====================================================
           TITRE
        ===================================================== */

        .login-heading {

            text-align: center;

            margin-bottom: 28px;

        }


        .login-heading h1 {

            margin: 0;

            font-size: 21px;

            font-weight: 900;

            color: #202522;

        }


        .login-heading p {

            margin: 7px 0 0;

            font-size: 13px;

            color: #77817b;

        }


        /* =====================================================
           LABELS
        ===================================================== */

        .form-label {

            font-size: 12px;

            font-weight: 800;

            color: #414944;

            margin-bottom: 7px;

        }


        /* =====================================================
           INPUTS
        ===================================================== */

        .input-group-custom {

            position: relative;

        }


        .input-icon {

            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: var(--uneac-green);

            z-index: 5;

            font-size: 17px;

        }


        .form-control {

            height: 50px;

            border-radius: 9px;

            border: 1px solid #d6dfda;

            padding-left: 45px;

            padding-right: 45px;

            font-size: 14px;

            background: #fbfcfb;

            transition: all .2s ease;

        }


        .form-control:focus {

            border-color: var(--uneac-green);

            box-shadow:
                0 0 0 3px rgba(8,127,63,.10);

            background: #ffffff;

        }


        .password-toggle {

            position: absolute;

            right: 13px;

            top: 50%;

            transform: translateY(-50%);

            border: 0;

            background: transparent;

            color: #7b847e;

            z-index: 5;

            cursor: pointer;

            font-size: 17px;

        }


        .password-toggle:hover {

            color: var(--uneac-green);

        }


        /* =====================================================
           REMEMBER
        ===================================================== */

        .login-options {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 15px;

            margin-bottom: 25px;

        }


        .form-check {

            margin: 0;

        }


        .form-check-input {

            border-color: #bdc9c1;

        }


        .form-check-input:checked {

            background-color: var(--uneac-green);

            border-color: var(--uneac-green);

        }


        .form-check-label {

            font-size: 12px;

            color: #68716c;

        }


        .forgot-link {

            font-size: 12px;

            font-weight: 700;

            color: var(--uneac-green);

            text-decoration: none;

        }


        .forgot-link:hover {

            color: var(--uneac-green-dark);

            text-decoration: underline;

        }


        /* =====================================================
           BOUTON
        ===================================================== */

        .btn-login {

            width: 100%;

            height: 51px;

            border: 0;

            border-radius: 9px;

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-green-dark),
                    var(--uneac-green)
                );

            color: #ffffff;

            font-size: 13px;

            font-weight: 900;

            letter-spacing: 1px;

            text-transform: uppercase;

            box-shadow:
                0 7px 18px rgba(8,127,63,.20);

            transition: all .2s ease;

        }


        .btn-login:hover {

            background:
                linear-gradient(
                    90deg,
                    var(--uneac-green-deep),
                    var(--uneac-green-dark)
                );

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 10px 22px rgba(8,127,63,.25);

        }


        .btn-login i {

            margin-right: 7px;

        }


        /* =====================================================
           FOOTER CARD
        ===================================================== */

        .login-footer {

            border-top: 1px solid #e7ece9;

            padding: 17px 25px;

            text-align: center;

            background: #fafcfb;

            font-size: 9px;

            font-weight: 800;

            letter-spacing: 1.4px;

            text-transform: uppercase;

            color: #8a938e;

        }


        .login-footer span {

            color: var(--uneac-green);

        }


        /* =====================================================
           ERREURS
        ===================================================== */

        .alert-login {

            border: 0;

            border-left: 4px solid #dc3545;

            border-radius: 6px;

            background: #fff5f5;

            color: #842029;

            font-size: 12px;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 500px) {

            .login-page {

                padding: 20px 15px;

            }


            .login-body {

                padding: 32px 23px 27px;

            }


            .logo-container {

                width: 85px;

                height: 85px;

            }


            .logo-container img {

                width: 70px;

                height: 70px;

            }


            .brand-title {

                font-size: 25px;

            }


            .login-options {

                align-items: flex-start;

                flex-direction: column;

                gap: 10px;

            }


            .login-card {

                border-radius: 15px;

            }

        }

    </style>

</head>


<body>


<div class="login-page">


    {{-- =====================================================
         DÉCORATIONS
    ====================================================== --}}

    <div class="decor decor-circle-1"></div>

    <div class="decor decor-circle-2"></div>

    <div class="decor decor-circle-3"></div>

    <div class="decor decor-zigzag"></div>



    <div class="login-wrapper">


        {{-- =================================================
             BRAND
        ================================================== --}}

        <div class="brand">


            <div class="logo-container">


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


            <h2 class="brand-title">

                UNEAC ID

            </h2>


            <div class="brand-subtitle">

                Plateforme de gestion des membres

            </div>


        </div>



        {{-- =================================================
             LOGIN CARD
        ================================================== --}}

        <div class="login-card">


            <div class="login-body">


                {{-- TITRE --}}

                <div class="login-heading">

                    <h1>

                        Bienvenue

                    </h1>


                    <p>

                        Connectez-vous à votre espace d'administration

                    </p>

                </div>



                {{-- =================================================
                     ERREURS
                ================================================== --}}

                @if($errors->any())

                    <div class="alert alert-login mb-4">

                        <i class="bi bi-exclamation-circle me-1"></i>

                        {{ $errors->first() }}

                    </div>

                @endif



                {{-- =================================================
                     FORMULAIRE
                ================================================== --}}

                <form
                    method="POST"
                    action="{{ route('login') }}"
                >

                    @csrf



                    {{-- EMAIL --}}

                    <div class="mb-3">


                        <label
                            for="email"
                            class="form-label"
                        >

                            Adresse e-mail

                        </label>


                        <div class="input-group-custom">


                            <i class="bi bi-envelope input-icon"></i>


                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="Votre adresse e-mail"
                                required
                                autofocus
                                autocomplete="username"
                            >


                        </div>

                    </div>



                    {{-- MOT DE PASSE --}}

                    <div class="mb-3">


                        <label
                            for="password"
                            class="form-label"
                        >

                            Mot de passe

                        </label>


                        <div class="input-group-custom">


                            <i class="bi bi-lock input-icon"></i>


                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Votre mot de passe"
                                required
                                autocomplete="current-password"
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                                aria-label="Afficher le mot de passe"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="passwordIcon"
                                ></i>

                            </button>


                        </div>

                    </div>



                    {{-- OPTIONS --}}

                    <div class="login-options">


                        <div class="form-check">


                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember"
                            >


                            <label
                                class="form-check-label"
                                for="remember"
                            >

                                Se souvenir de moi

                            </label>


                        </div>



                        @if(Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="forgot-link"
                            >

                                Mot de passe oublié ?

                            </a>

                        @endif


                    </div>



                    {{-- BOUTON --}}

                    <button
                        type="submit"
                        class="btn btn-login"
                    >

                        <i class="bi bi-box-arrow-in-right"></i>

                        Se connecter

                    </button>


                </form>


            </div>



            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="login-footer">

                <span>UNEAC</span>

                &nbsp; • &nbsp;

                IDENTITÉ

                &nbsp; • &nbsp;

                CULTURE

                &nbsp; • &nbsp;

                ART

            </div>


        </div>


    </div>


</div>



<script>

function togglePassword() {

    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('passwordIcon');


    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }

}

</script>


</body>

</html>
