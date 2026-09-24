<div
    class="modal fade"
    id="modalModifierUtilisateur"
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

                    <div class="modal-icon gold">

                        <svg viewBox="0 0 24 24">
                            <path d="M4 20h4L19 9l-4-4L4 16v4z"></path>
                            <path d="M13 6l4 4"></path>
                        </svg>

                    </div>

                    <div>

                        <h5>
                            Modifier l'utilisateur
                        </h5>

                        <small>
                            Modifier les informations du compte
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
                id="formModifierUtilisateur"
                autocomplete="off"
            >

                @csrf
                @method('PUT')


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
                            id="editUserName"
                            class="form-control modern-input"
                            placeholder="Nom complet"
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
                            id="editUserEmail"
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
                            id="editUserRole"
                            class="form-select modern-input"
                            required
                        >

                            <option value="admin_uneac">
                                Administrateur UNEAC
                            </option>

                            <option value="super_admin">
                                Super Administrateur
                            </option>

                        </select>

                    </div>


                    {{-- =================================================
                         INFORMATION MOT DE PASSE
                    ================================================== --}}

                    <div class="password-info">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"
                            ></path>

                            <path d="M12 8v4"></path>

                            <path d="M12 15h.01"></path>

                        </svg>

                        <span>
                            Laissez les champs de mot de passe vides
                            pour conserver le mot de passe actuel.
                        </span>

                    </div>


                    {{-- =================================================
                         MOT DE PASSE
                    ================================================== --}}

                    <div class="row">


                        {{-- Nouveau mot de passe --}}
                        <div class="col-md-6">

                            <div class="form-group-modern">

                                <label>
                                    Nouveau mot de passe
                                </label>

                                <div class="password-field">

                                    <input
                                        type="password"
                                        name="password"
                                        id="editUserPassword"
                                        class="form-control modern-input"
                                        placeholder="Nouveau mot de passe"
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="editUserPassword"
                                        aria-label="Afficher le mot de passe"
                                    >

                                        {{-- Œil fermé --}}
                                        <svg
                                            class="eye-closed"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                            ></path>

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            ></circle>

                                            <path
                                                d="M4 4l16 16"
                                            ></path>

                                        </svg>


                                        {{-- Œil ouvert --}}
                                        <svg
                                            class="eye-open"
                                            viewBox="0 0 24 24"
                                            style="display:none;"
                                        >

                                            <path
                                                d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                            ></path>

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            ></circle>

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
                                        id="editUserPasswordConfirmation"
                                        class="form-control modern-input"
                                        placeholder="Confirmer"
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="editUserPasswordConfirmation"
                                        aria-label="Afficher la confirmation"
                                    >

                                        {{-- Œil fermé --}}
                                        <svg
                                            class="eye-closed"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                            ></path>

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            ></circle>

                                            <path
                                                d="M4 4l16 16"
                                            ></path>

                                        </svg>


                                        {{-- Œil ouvert --}}
                                        <svg
                                            class="eye-open"
                                            viewBox="0 0 24 24"
                                            style="display:none;"
                                        >

                                            <path
                                                d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                            ></path>

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            ></circle>

                                        </svg>

                                    </button>

                                </div>

                            </div>

                        </div>

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

                            <path d="M5 12l4 4L19 6"></path>

                        </svg>

                        Enregistrer

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
        .querySelectorAll('#modalModifierUtilisateur .password-toggle')
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
