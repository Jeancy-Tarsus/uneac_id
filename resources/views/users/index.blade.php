@extends('adminlte::page')

@section('title', 'Gestion des utilisateurs')

@section('content_header')
@stop

@section('content')

<div class="users-page">

    {{-- =========================================================
         EN-TÊTE
    ========================================================== --}}

    <div class="users-header mb-4">

        <div>

            <div class="users-title">

                <div class="users-title-icon">

                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"></circle>
                        <path d="M2 21c0-4 3-7 7-7s7 3 7 7"></path>
                        <path d="M16 11c3 0 6 2 6 6"></path>
                        <path d="M16 4a4 4 0 0 1 0 8"></path>
                    </svg>

                </div>

                <div>

                    <h3>
                        Gestion des utilisateurs
                    </h3>

                    <p>
                        Gérez les comptes et les accès à la plateforme UNEAC ID.
                    </p>

                </div>

            </div>

        </div>


        @if(auth()->user()->role === 'super_admin')
        <button
            type="button"
            class="btn btn-uneac"
            data-bs-toggle="modal"
            data-bs-target="#modalAjouterUtilisateur"
        >

            <svg viewBox="0 0 24 24">
                <path d="M12 5v14"></path>
                <path d="M5 12h14"></path>
            </svg>

            Ajouter un utilisateur

        </button>
        @endif

    </div>


    {{-- =========================================================
         STATISTIQUES
    ========================================================== --}}

    <div class="row mb-4">

        {{-- Total --}}
        <div class="col-lg-4 col-md-6 mb-3">

            <div class="user-stat-card">

                <div class="stat-icon green">

                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"></circle>
                        <path d="M2 21c0-4 3-7 7-7s7 3 7 7"></path>
                        <path d="M17 11a4 4 0 1 1 0-8"></path>
                    </svg>

                </div>

                <div>

                    <span>Total utilisateurs</span>

                    <strong>
                        {{ $users->total() }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- Super admin --}}
        <div class="col-lg-4 col-md-6 mb-3">

            <div class="user-stat-card">

                <div class="stat-icon dark">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>

                </div>

                <div>

                    <span>Super administrateurs</span>

                    <strong>
                        {{ \App\Models\User::where('role', 'super_admin')->count() }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- Admin UNEAC --}}
        <div class="col-lg-4 col-md-6 mb-3">

            <div class="user-stat-card">

                <div class="stat-icon blue">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"></circle>
                        <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                    </svg>

                </div>

                <div>

                    <span>Administrateurs UNEAC</span>

                    <strong>
                        {{ \App\Models\User::where('role', 'admin_uneac')->count() }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTRES
    ========================================================== --}}

    <div class="filter-card mb-4">

        <form
            method="GET"
            action="{{ route('users.index') }}"
        >

            <div class="row align-items-end">

                {{-- Recherche --}}
                <div class="col-lg-5 mb-3 mb-lg-0">

                    <label>
                        Rechercher
                    </label>

                    <div class="search-input">

                        <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="M16 16l5 5"></path>
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nom ou adresse e-mail..."
                        >

                    </div>

                </div>


                {{-- Rôle --}}
                <div class="col-lg-4 mb-3 mb-lg-0">

                    <label>
                        Rôle
                    </label>

                    <select
                        name="role"
                        class="form-select user-select"
                    >

                        <option value="">
                            Tous les rôles
                        </option>

                        <option
                            value="super_admin"
                            {{ request('role') === 'super_admin' ? 'selected' : '' }}
                        >
                            Super Administrateur
                        </option>

                        <option
                            value="admin_uneac"
                            {{ request('role') === 'admin_uneac' ? 'selected' : '' }}
                        >
                            Administrateur UNEAC
                        </option>

                    </select>

                </div>


                {{-- Boutons --}}
                <div class="col-lg-3">

                    <div class="filter-buttons">

                        <button
                            type="submit"
                            class="btn btn-filter"
                        >

                            <svg viewBox="0 0 24 24">
                                <path d="M3 5h18"></path>
                                <path d="M6 12h12"></path>
                                <path d="M10 19h4"></path>
                            </svg>

                            Filtrer

                        </button>

                        @if(request('search') || request('role'))

                            <a
                                href="{{ route('users.index') }}"
                                class="btn btn-reset"
                                title="Réinitialiser la recherche"
                            >

                                <svg viewBox="0 0 24 24">
                                    <path d="M3 12a9 9 0 1 0 3-6.7"></path>
                                    <path d="M3 4v6h6"></path>
                                </svg>

                                Réinitialiser

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
         TABLEAU
    ========================================================== --}}

    <div class="users-table-card">

        <div class="table-card-header">

            <div>

                <h5>
                    Liste des utilisateurs
                </h5>

                <span>
                    {{ $users->total() }} utilisateur(s)
                </span>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table users-table mb-0">

                <thead>

                    <tr>

                        <th>
                            UTILISATEUR
                        </th>

                        <th>
                            E-MAIL
                        </th>

                        <th>
                            RÔLE
                        </th>

                        <th>
                            CRÉÉ LE
                        </th>

                        <th class="text-center">
                            ACTIONS
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($users as $user)

                    <tr>

                        {{-- Utilisateur --}}
                        <td>

                            <div class="user-cell">

                                <div class="user-avatar">

                                    {{ strtoupper(substr($user->name, 0, 1)) }}

                                </div>

                                <div>

                                    <strong>
                                        {{ $user->name }}
                                    </strong>

                                    @if(auth()->id() === $user->id)

                                        <span class="you-badge">
                                            Vous
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- Email --}}
                        <td>

                            <span class="user-email">
                                {{ $user->email }}
                            </span>

                        </td>


                        {{-- Rôle --}}
                        <td>

                            @if($user->role === 'super_admin')

                                <span class="role-badge role-super">

                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"></path>
                                        <path d="M9 12l2 2 4-4"></path>
                                    </svg>

                                    Super Administrateur

                                </span>

                            @else

                                <span class="role-badge role-uneac">

                                    <svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4"></circle>
                                        <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path>
                                    </svg>

                                    Administrateur UNEAC

                                </span>

                            @endif

                        </td>


                        {{-- Date --}}
                        <td>

                            <span class="date-cell">
                                {{ $user->created_at?->format('d/m/Y') }}
                            </span>

                        </td>


                        {{-- Actions --}}
                        <td>

                            @if(auth()->user()->role === 'super_admin')
                            <div class="action-buttons">

                                {{-- Voir --}}
                                <button
                                    type="button"
                                    class="action-btn view"
                                    title="Voir"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalVoirUtilisateur"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ $user->role }}"
                                    data-created="{{ $user->created_at?->format('d/m/Y') }}"
                                >

                                    <svg viewBox="0 0 24 24">
                                        <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"></path>
                                        <circle cx="12" cy="12" r="2.5"></circle>
                                    </svg>

                                </button>


                                {{-- Modifier --}}
                                <button
                                    type="button"
                                    class="action-btn edit"
                                    title="Modifier"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierUtilisateur"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ $user->role }}"
                                >

                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 20h4L19 9l-4-4L4 16v4z"></path>
                                        <path d="M13 6l4 4"></path>
                                    </svg>

                                </button>


                                {{-- Supprimer : confirmation SweetAlert --}}
                                @if(auth()->id() !== $user->id)

                                    <form
                                        action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        class="d-inline delete-user-form"
                                        data-name="{{ $user->name }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            class="action-btn delete"
                                            title="Supprimer"
                                        >
                                            <svg viewBox="0 0 24 24">
                                                <path d="M4 7h16"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M6 7l1 14h10l1-14"></path>
                                                <path d="M9 7V4h6v3"></path>
                                            </svg>
                                        </button>
                                    </form>

                                @endif

                            </div>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="empty-state"
                        >

                            <div class="empty-icon">

                                <svg viewBox="0 0 24 24">
                                    <circle cx="9" cy="8" r="4"></circle>
                                    <path d="M2 21c0-4 3-7 7-7s7 3 7 7"></path>
                                </svg>

                            </div>

                            <strong>
                                Aucun utilisateur trouvé
                            </strong>

                            <p>
                                Aucun utilisateur ne correspond aux critères de recherche.
                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($users->hasPages())

            <div class="pagination-wrapper">

                {{ $users->links() }}

            </div>

        @endif

    </div>

</div>

{{-- =============================================================
     MODALES
============================================================= --}}

@include('users.modals.create')
@include('users.modals.view')
@include('users.modals.edit')


{{-- =============================================================
     SWEETALERT
============================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))

<script>

Swal.fire({
    icon: 'success',
    title: 'Opération réussie',
    text: @json(session('success')),
    confirmButtonColor: '#087f3f',
    timer: 2500,
    timerProgressBar: true
});

</script>

@endif


@if(session('error'))

<script>

Swal.fire({
    icon: 'error',
    title: 'Opération impossible',
    text: @json(session('error')),
    confirmButtonColor: '#dc3545'
});

</script>

@endif


@if($errors->any())

<script>

Swal.fire({
    icon: 'error',
    title: 'Erreur',
    html: @json(implode('<br>', $errors->all())),
    confirmButtonColor: '#087f3f'
});

</script>

@endif


{{-- =============================================================
     JAVASCRIPT MODALES
============================================================= --}}



<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-user-form .action-btn.delete').forEach(function (button) {
        button.addEventListener('click', function () {
            const form = button.closest('.delete-user-form');
            const name = form?.dataset.name || 'cet utilisateur';

            Swal.fire({
                icon: 'warning',
                title: 'Supprimer cet utilisateur ?',
                text: `Le compte « ${name} » sera définitivement supprimé.`,
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const modalVoir = document.getElementById('modalVoirUtilisateur');
    if (modalVoir) {
        modalVoir.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const name = button.dataset.name || '';
            const email = button.dataset.email || '';
            const role = button.dataset.role || '';
            const created = button.dataset.created || '';

            document.getElementById('viewUserAvatar').textContent =
                name.charAt(0).toUpperCase();

            document.getElementById('viewUserName').textContent = name || '—';
            document.getElementById('viewUserEmail').textContent = email || '—';
            document.getElementById('viewUserCreated').textContent = created || '—';

            const roleElement = document.getElementById('viewUserRole');

            if (role === 'super_admin') {
                roleElement.textContent = 'Super Administrateur';
                roleElement.className = 'role-badge role-super';
            } else {
                roleElement.textContent = 'Administrateur UNEAC';
                roleElement.className = 'role-badge role-uneac';
            }
        });
    }

    const modalModifier = document.getElementById('modalModifierUtilisateur');

    if (modalModifier) {
        modalModifier.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            if (!button) {
                return;
            }

            const id = button.dataset.id;

            // Vider les champs avant de charger les données.
            document.getElementById('editUserName').value = '';
            document.getElementById('editUserEmail').value = '';
            document.getElementById('editUserRole').value = 'admin_uneac';

            modalModifier.querySelector('input[name="password"]').value = '';
            modalModifier.querySelector('input[name="password_confirmation"]').value = '';

            // Empêcher une ancienne action de rester sur le formulaire.
            document.getElementById('formModifierUtilisateur').action = '';

            fetch(`{{ url('users') }}/${id}/edit`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {

                if (!response.ok) {
                    throw new Error('Impossible de récupérer les informations de l’utilisateur.');
                }

                return response.json();
            })
            .then(user => {

                // IMPORTANT : chaque valeur va dans son propre champ.
                document.getElementById('editUserName').value = user.name ?? '';
                document.getElementById('editUserEmail').value = user.email ?? '';
                document.getElementById('editUserRole').value = user.role ?? 'admin_uneac';

                document.getElementById('formModifierUtilisateur').action =
                    `{{ url('users') }}/${user.id}`;
            })
            .catch(error => {

                console.error(error);

                // Fermer la modale si les données ne peuvent pas être chargées.
                bootstrap.Modal.getOrCreateInstance(modalModifier).hide();

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Impossible de récupérer les informations de cet utilisateur.',
                    confirmButtonText: 'Fermer',
                    confirmButtonColor: '#087f3f'
                });
            });
        });
    }

});
</script>

{{-- =============================================================
     STYLE
============================================================= --}}

<style>

/* =============================================================
   PAGE
============================================================= */

.users-page {
    max-width: 1500px;
    margin: 0 auto;
    padding-top: 28px;
    padding-bottom: 35px;
}


/* =============================================================
   HEADER
============================================================= */

.users-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 28px;
    margin-bottom: 30px;
}

.users-title {

    display: flex;

    align-items: center;

    gap: 14px;
}

.users-title-icon {

    width: 48px;
    height: 48px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: rgba(8,127,63,.10);

    color: #087f3f;
}

.users-title-icon svg {

    width: 24px;
    height: 24px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.users-title h3 {

    margin: 0;

    font-size: 22px;

    font-weight: 700;
}

.users-title p {

    margin: 4px 0 0;

    color: var(--bs-secondary-color);

    font-size: 12px;
}


/* =============================================================
   BOUTON UNEAC
============================================================= */

.btn-uneac {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 40px;

    padding: 9px 16px;

    border: 0;

    border-radius: 8px;

    background: #087f3f;

    color: #fff;

    font-size: 13px;

    font-weight: 600;

    flex-shrink: 0;

    transition: .2s ease;
}

.btn-uneac:hover {

    background: #066b35;

    color: #fff;

    transform: translateY(-1px);
}

.btn-uneac svg {

    width: 16px;
    height: 16px;

    flex-shrink: 0;

    fill: none;

    stroke: currentColor;

    stroke-width: 2;

    stroke-linecap: round;
}


/* =============================================================
   STATISTIQUES
============================================================= */

.user-stat-card {

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 18px;

    background: var(--bs-body-bg);

    border: 1px solid var(--bs-border-color);

    border-radius: 12px;

    box-shadow: 0 3px 12px rgba(0,0,0,.025);
}

.stat-icon {

    width: 45px;
    height: 45px;

    min-width: 45px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;
}

.stat-icon.green {

    background: rgba(8,127,63,.10);

    color: #087f3f;
}

.stat-icon.dark {

    background: rgba(33,37,41,.10);

    color: #495057;
}

.stat-icon.blue {

    background: rgba(13,110,253,.10);

    color: #0d6efd;
}

.stat-icon svg {

    width: 20px;
    height: 20px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}

.user-stat-card span {

    display: block;

    color: var(--bs-secondary-color);

    font-size: 11px;
}

.user-stat-card strong {

    display: block;

    margin-top: 2px;

    font-size: 22px;

    font-weight: 700;
}


/* =============================================================
   FILTRES
============================================================= */

.filter-card {

    padding: 18px;

    background: var(--bs-body-bg);

    border: 1px solid var(--bs-border-color);

    border-radius: 12px;
}

.filter-card label {

    display: block;

    margin-bottom: 6px;

    color: var(--bs-body-color);

    font-size: 12px;

    font-weight: 600;
}

.search-input {

    position: relative;
}

.search-input svg {

    position: absolute;

    left: 13px;

    top: 50%;

    width: 17px;
    height: 17px;

    transform: translateY(-50%);

    fill: none;

    stroke: var(--bs-secondary-color);

    stroke-width: 1.8;

    stroke-linecap: round;
}

.search-input input {

    width: 100%;

    height: 42px;

    padding: 9px 13px 9px 40px;

    border: 1px solid var(--bs-border-color);

    border-radius: 8px;

    background: var(--bs-body-bg);

    color: var(--bs-body-color);

    outline: none;
}

.search-input input:focus {

    border-color: #087f3f;

    box-shadow:
        0 0 0 3px rgba(8,127,63,.10);
}

.user-select {

    height: 42px;

    border-radius: 8px;
}

.btn-filter {

    height: 42px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    border-radius: 8px;

    background: var(--bs-tertiary-bg);

    border: 1px solid var(--bs-border-color);

    color: var(--bs-body-color);

    font-size: 12px;

    font-weight: 600;

    white-space: nowrap;
}

.btn-filter:hover {

    border-color: #087f3f;

    color: #087f3f;
}

.btn-filter svg {

    width: 16px;
    height: 16px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
}


/* =============================================================
   BOUTONS FILTRE
============================================================= */

.filter-buttons {

    display: flex;

    align-items: center;

    gap: 8px;

    width: 100%;
}

.filter-buttons .btn-filter {

    flex: 1;

    min-width: 0;
}

.btn-filter {

    height: 42px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    padding: 8px 12px;

    border-radius: 8px;

    background: var(--bs-tertiary-bg);

    border: 1px solid var(--bs-border-color);

    color: var(--bs-body-color);

    font-size: 12px;

    font-weight: 600;

    white-space: nowrap;
}

.btn-filter:hover {

    border-color: #087f3f;

    color: #087f3f;
}

.btn-filter svg {

    width: 16px;

    height: 16px;

    flex-shrink: 0;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
}

.btn-reset {

    height: 42px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    padding: 8px 12px;

    border-radius: 8px;

    background: rgba(220,53,69,.08);

    border: 1px solid rgba(220,53,69,.18);

    color: #dc3545;

    font-size: 12px;

    font-weight: 600;

    text-decoration: none;

    white-space: nowrap;

    flex-shrink: 0;

    transition: .15s ease;
}

.btn-reset:hover {

    background: rgba(220,53,69,.14);

    border-color: rgba(220,53,69,.25);

    color: #dc3545;

    transform: translateY(-1px);
}

.btn-reset svg {

    width: 16px;

    height: 16px;

    flex-shrink: 0;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}


/* =============================================================
   TABLEAU
============================================================= */

.users-table-card {

    overflow: hidden;

    background: var(--bs-body-bg);

    border: 1px solid var(--bs-border-color);

    border-radius: 13px;

    box-shadow: 0 3px 14px rgba(0,0,0,.025);
}

.table-card-header {

    padding: 18px 20px;

    border-bottom: 1px solid var(--bs-border-color);
}

.table-card-header h5 {

    margin: 0;

    font-size: 14px;

    font-weight: 700;
}

.table-card-header span {

    display: block;

    margin-top: 3px;

    color: var(--bs-secondary-color);

    font-size: 10px;
}

.users-table {

    color: var(--bs-body-color);
}

.users-table thead th {

    padding: 13px 18px;

    background: var(--bs-tertiary-bg);

    color: var(--bs-secondary-color);

    border-bottom: 1px solid var(--bs-border-color);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: .5px;
}

.users-table tbody td {

    padding: 14px 18px;

    vertical-align: middle;

    border-bottom: 1px solid var(--bs-border-color);

    font-size: 14px;
}

.users-table tbody tr:last-child td {

    border-bottom: 0;
}

.users-table tbody tr {

    transition: background .15s ease;
}

.users-table tbody tr:hover {

    background: rgba(8,127,63,.025);
}


/* =============================================================
   UTILISATEUR
============================================================= */

.user-cell {

    display: flex;

    align-items: center;

    gap: 11px;
}

.user-avatar {

    width: 38px;
    height: 38px;

    min-width: 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: rgba(8,127,63,.10);

    color: #087f3f;

    font-weight: 700;

    font-size: 13px;
}

.user-cell strong {

    font-size: 14px;

    font-weight: 600;
}

.you-badge {

    display: inline-block;

    margin-left: 5px;

    padding: 2px 6px;

    border-radius: 10px;

    background: rgba(8,127,63,.10);

    color: #087f3f;

    font-size: 8px;

    font-weight: 700;
}

.user-email {

    color: var(--bs-secondary-color);

    font-size: 13px;
}

.date-cell {

    color: var(--bs-secondary-color);

    font-size: 13px;
}


/* =============================================================
   ROLE
============================================================= */

.role-badge {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 10px;

    border-radius: 20px;

    font-size: 10.5px;

    font-weight: 600;
}

.role-badge svg {

    width: 13px;
    height: 13px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}

.role-super {

    background: rgba(33,37,41,.09);

    color: var(--bs-body-color);
}

.role-uneac {

    background: rgba(8,127,63,.10);

    color: #087f3f;
}


/* =============================================================
   ACTIONS
============================================================= */

.action-buttons {

    display: flex;

    justify-content: center;

    gap: 5px;
}

.action-btn {

    width: 34px;
    height: 34px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid transparent;

    border-radius: 8px;

    background: transparent;

    transition: .15s ease;
}

.action-btn svg {

    width: 15px;
    height: 15px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}

.action-btn.view {

    color: #0d6efd;

    background: rgba(13,110,253,.08);
}

.action-btn.edit {

    color: #b77900;

    background: rgba(255,193,7,.12);
}

.action-btn.delete {

    color: #dc3545;

    background: rgba(220,53,69,.08);
}

.action-btn:hover {

    transform: translateY(-1px);
}

.action-btn.view:hover {

    background: rgba(13,110,253,.15);
}

.action-btn.edit:hover {

    background: rgba(255,193,7,.20);
}

.action-btn.delete:hover {

    background: rgba(220,53,69,.15);
}


/* =============================================================
   EMPTY
============================================================= */

.empty-state {

    padding: 55px 20px !important;

    text-align: center;
}

.empty-icon {

    width: 55px;
    height: 55px;

    margin: 0 auto 12px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: rgba(8,127,63,.08);

    color: #087f3f;
}

.empty-icon svg {

    width: 25px;
    height: 25px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.6;

    stroke-linecap: round;

    stroke-linejoin: round;
}

.empty-state strong {

    display: block;

    font-size: 14px;
}

.empty-state p {

    margin: 5px 0 0;

    color: var(--bs-secondary-color);

    font-size: 11px;
}


/* =============================================================
   MODALES
============================================================= */

.modal-content {

    overflow: hidden;

    border: 1px solid var(--bs-border-color);

    border-radius: 15px;

    background: var(--bs-body-bg);

    color: var(--bs-body-color);

    box-shadow:
        0 20px 50px rgba(0,0,0,.15);
}

.modal-header {

    padding: 18px 20px;

    border-bottom: 1px solid var(--bs-border-color);
}

.modal-title-wrapper {

    display: flex;

    align-items: center;

    gap: 12px;
}

.modal-title-wrapper h5 {

    margin: 0;

    font-size: 15px;

    font-weight: 700;
}

.modal-title-wrapper small {

    display: block;

    margin-top: 3px;

    color: var(--bs-secondary-color);

    font-size: 10px;
}

.modal-icon {

    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;
}

.modal-icon.green {

    background: rgba(8,127,63,.10);

    color: #087f3f;
}

.modal-icon.blue {

    background: rgba(13,110,253,.10);

    color: #0d6efd;
}

.modal-icon.gold {

    background: rgba(255,193,7,.12);

    color: #b77900;
}

.modal-icon svg {

    width: 20px;
    height: 20px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}

.modal-body {

    padding: 22px;
}

.modal-footer {

    padding: 15px 20px;

    border-top: 1px solid var(--bs-border-color);
}

.form-group-modern {

    margin-bottom: 17px;
}

.form-group-modern label {

    display: block;

    margin-bottom: 6px;

    color: var(--bs-body-color);

    font-size: 12px;

    font-weight: 600;
}

.modern-input {

    min-height: 42px;

    border-radius: 8px !important;

    border-color: var(--bs-border-color) !important;

    background: var(--bs-body-bg) !important;

    color: var(--bs-body-color) !important;

    font-size: 12px;
}

.modern-input:focus {

    border-color: #087f3f !important;

    box-shadow:
        0 0 0 3px rgba(8,127,63,.10) !important;
}

.btn-light-custom {

    min-height: 39px;

    padding: 8px 16px;

    border: 1px solid var(--bs-border-color);

    border-radius: 8px;

    background: var(--bs-tertiary-bg);

    color: var(--bs-body-color);

    font-size: 12px;

    font-weight: 600;
}

.btn-light-custom:hover {

    background: var(--bs-secondary-bg);

    color: var(--bs-body-color);
}

.password-info {

    display: flex;

    align-items: flex-start;

    gap: 9px;

    margin-bottom: 18px;

    padding: 10px 12px;

    border-radius: 8px;

    background: rgba(13,110,253,.06);

    color: var(--bs-secondary-color);

    font-size: 10px;

    line-height: 1.5;
}

.password-info svg {

    width: 16px;
    height: 16px;

    min-width: 16px;

    margin-top: 1px;

    fill: none;

    stroke: #0d6efd;

    stroke-width: 1.8;

    stroke-linecap: round;

    stroke-linejoin: round;
}


/* =============================================================
   VOIR
============================================================= */

.view-user-avatar {

    width: 75px;
    height: 75px;

    margin: 0 auto 12px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(8,127,63,.10);

    color: #087f3f;

    font-size: 25px;

    font-weight: 700;
}

.view-user-name {

    text-align: center;

    margin: 0;

    font-size: 18px;

    font-weight: 700;
}

.view-user-email {

    text-align: center;

    margin: 5px 0 20px;

    color: var(--bs-secondary-color);

    font-size: 12px;
}

.view-info-list {

    border-top: 1px solid var(--bs-border-color);
}

.view-info-row {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 13px 0;

    border-bottom: 1px solid var(--bs-border-color);
}

.view-info-row:last-child {
    border-bottom: 0;
}

.view-info-row span {

    color: var(--bs-secondary-color);

    font-size: 11px;
}

.view-info-row strong {
    font-size: 11px;
}


/* =============================================================
   DARK MODE
============================================================= */

[data-bs-theme="dark"] .user-stat-card,
[data-bs-theme="dark"] .filter-card,
[data-bs-theme="dark"] .users-table-card,
[data-bs-theme="dark"] .modal-content {

    box-shadow: none;
}

[data-bs-theme="dark"] .users-table tbody tr:hover {

    background: rgba(25,135,84,.06);
}

[data-bs-theme="dark"] .role-super {

    background: rgba(255,255,255,.08);

    color: var(--bs-body-color);
}

[data-bs-theme="dark"] .role-uneac {

    background: rgba(25,135,84,.14);

    color: #45c77d;
}

[data-bs-theme="dark"] .search-input input,
[data-bs-theme="dark"] .modern-input {

    background: var(--bs-body-bg) !important;

    color: var(--bs-body-color) !important;
}


/* =============================================================
   RESPONSIVE
============================================================= */

@media (max-width: 992px) {

    .filter-buttons {
        flex-direction: column;
    }

    .filter-buttons .btn-filter,
    .btn-reset {
        width: 100%;
    }

}


@media (max-width: 768px) {

    .users-header {

        align-items: flex-start;

        flex-direction: column;
    }

    .btn-uneac {

        width: 100%;
    }

    .users-title h3 {

        font-size: 19px;
    }

    .profile-stat-card {

        margin-bottom: 10px;
    }

}

</style>

@stop
