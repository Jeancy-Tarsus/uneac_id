<div
    class="modal fade"
    id="modalAjouterUtilisateur"
    tabindex="-1"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- =====================================================
                 EN-TÊTE
            ====================================================== --}}

            <div class="modal-header">

                <div class="modal-title-wrapper">

                    <div class="modal-icon green">

                        <svg viewBox="0 0 24 24">
                            <circle cx="9" cy="8" r="4"></circle>
                            <path d="M2 21c0-4 3-7 7-7s7 3 7 7"></path>
                            <path d="M19 13v7"></path>
                            <path d="M15.5 16.5h7"></path>
                        </svg>

                    </div>

                    <div>

                        <h5>
                            Ajouter un utilisateur
                        </h5>

                        <small>
                            Créer un nouveau compte
                        </small>

                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>

            </div>


            {{-- =====================================================
                 FORMULAIRE
            ====================================================== --}}

            <form
                method="POST"
                action="{{ route('users.store') }}"
                autocomplete="off"
            >

                @csrf

                <div class="modal-body">

                    {{-- =================================================
                         NOM
                    ================================================== --}}

                    <div class="form-group-modern">

                        <label>
                            Nom complet
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control modern-input"
                            placeholder="Ex. Jean Dupont"
                            autocomplete="off"
                            required
                        >

                    </div>


                    {{-- =================================================
                         EMAIL
                    ================================================== --}}

                    <div class="form-group-modern">

                        <label>
                            Adresse e-mail
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control modern-input"
                            placeholder="exemple@uneac.cg"
                            autocomplete="off"
                            required
                        >

                    </div>


                    {{-- =================================================
                         RÔLE
                    ================================================== --}}

                    <div class="form-group-modern">

                        <label>
                            Rôle
                        </label>

                        <select
                            name="role"
                            class="form-select modern-input"
                            required
                        >

                            <option value="">
                                Sélectionner un rôle
                            </option>

                            <option value="admin_uneac">
                                Administrateur UNEAC
                            </option>

                            <option value="super_admin">
                                Super Administrateur
                            </option>

                        </select>

                    </div>


                    {{-- =================================================
                         MOTS DE PASSE
                    ================================================== --}}

                    <div class="row">

                        {{-- Mot de passe --}}
                        <div class="col-md-6">

                            <div class="form-group-modern">

                                <label>
                                    Mot de passe
                                </label>

                                <div class="password-field">

                                    <input
                                        type="password"
                                        name="password"
                                        id="createUserPassword"
                                        class="form-control modern-input"
                                        placeholder="Minimum 8 caractères"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="createUserPassword"
                                        aria-label="Afficher le mot de passe"
                                    >

                                        {{-- Œil fermé --}}
                                        <svg
                                            class="eye-closed"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"></path>
                                            <circle cx="12" cy="12" r="2.5"></circle>
                                            <path d="M4 4l16 16"></path>
                                        </svg>

                                        {{-- Œil ouvert --}}
                                        <svg
                                            class="eye-open"
                                            viewBox="0 0 24 24"
                                            style="display:none;"
                                        >
                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"></path>
                                            <circle cx="12" cy="12" r="2.5"></circle>
                                        </svg>

                                    </button>

                                </div>

                            </div>

                        </div>


                        {{-- Confirmation --}}
                        <div class="col-md-6">

                            <div class="form-group-modern">

                                <label>
                                    Confirmation
                                </label>

                                <div class="password-field">

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="createUserPasswordConfirmation"
                                        class="form-control modern-input"
                                        placeholder="Confirmer"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="createUserPasswordConfirmation"
                                        aria-label="Afficher la confirmation du mot de passe"
                                    >

                                        {{-- Œil fermé --}}
                                        <svg
                                            class="eye-closed"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"></path>
                                            <circle cx="12" cy="12" r="2.5"></circle>
                                            <path d="M4 4l16 16"></path>
                                        </svg>

                                        {{-- Œil ouvert --}}
                                        <svg
                                            class="eye-open"
                                            viewBox="0 0 24 24"
                                            style="display:none;"
                                        >
                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"></path>
                                            <circle cx="12" cy="12" r="2.5"></circle>
                                        </svg>

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Information --}}
                    <div class="password-info">

                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 10v6"></path>
                            <path d="M12 7h.01"></path>
                        </svg>

                        <span>
                            Le mot de passe doit contenir au minimum
                            <strong>8 caractères</strong>.
                        </span>

                    </div>

                </div>


                {{-- =====================================================
                     PIED DE MODALE
                ====================================================== --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light-custom"
                        data-bs-dismiss="modal"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="btn btn-uneac"
                    >

                        <svg viewBox="0 0 24 24">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>

                        Créer l'utilisateur

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
     STYLE MOT DE PASSE
============================================================= --}}

<style>

.password-field {

    position: relative;
}

.password-field .modern-input {

    padding-right: 45px;
}

.password-toggle {

    position: absolute;

    top: 50%;

    right: 10px;

    width: 30px;

    height: 30px;

    display: flex;

    align-items: center;

    justify-content: center;

    transform: translateY(-50%);

    padding: 0;

    border: 0;

    background: transparent;

    color: var(--bs-secondary-color);

    cursor: pointer;

    border-radius: 6px;

    transition: .15s ease;
}

.password-toggle:hover {

    background: var(--bs-tertiary-bg);

    color: #087f3f;
}

.password-toggle svg {

    width: 17px;

    height: 17px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}

</style>


{{-- =============================================================
     JAVASCRIPT MOT DE PASSE
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    document
        .querySelectorAll('.password-toggle')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const targetId =
                    button.getAttribute('data-target');

                const input =
                    document.getElementById(targetId);

                if (!input) {
                    return;
                }

                const eyeClosed =
                    button.querySelector('.eye-closed');

                const eyeOpen =
                    button.querySelector('.eye-open');


                if (input.type === 'password') {

                    input.type = 'text';

                    eyeClosed.style.display = 'none';

                    eyeOpen.style.display = 'block';

                    button.setAttribute(
                        'aria-label',
                        'Masquer le mot de passe'
                    );

                } else {

                    input.type = 'password';

                    eyeClosed.style.display = 'block';

                    eyeOpen.style.display = 'none';

                    button.setAttribute(
                        'aria-label',
                        'Afficher le mot de passe'
                    );

                }

            });

        });

});

</script>
