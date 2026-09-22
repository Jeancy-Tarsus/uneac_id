@extends('adminlte::page')

@section('title', 'Réception des cartes')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <div>
        <h1 class="fw-bold mb-1">
            Réception des cartes
        </h1>

        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Tableau de bord
                </a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('cards.index') }}">
                    Cartes
                </a>
            </li>

            <li class="breadcrumb-item active">
                Réception UNEAC
            </li>
        </ol>
    </div>

    <a href="{{ route('cards.index') }}"
       class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Retour aux cartes

    </a>

</div>

@stop


@section('content')

<div class="container-fluid">


    {{-- ===================================================== --}}
    {{-- INTRODUCTION --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm reception-banner mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <div class="d-flex align-items-center">

                        <div class="page-icon me-3">

                            <i class="bi bi-box-arrow-in-down"></i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Réception des cartes par l’UNEAC
                            </h4>

                            <p class="text-muted mb-0">
                                Sélectionnez les cartes physiquement reçues par
                                l’UNEAC, puis enregistrez leur réception.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-4 mt-3 mt-lg-0">

                    <div class="process-info">

                        <div class="process-item active">
                            <span>1</span>
                            Production
                        </div>

                        <i class="bi bi-chevron-right"></i>

                        <div class="process-item current">
                            <span>2</span>
                            Réception UNEAC
                        </div>

                        <i class="bi bi-chevron-right"></i>

                        <div class="process-item">
                            <span>3</span>
                            Remise artiste
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- RECHERCHE --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center mb-3">

                <div class="filter-icon me-3">
                    <i class="bi bi-search"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Rechercher une carte
                    </h5>

                    <small class="text-muted">
                        La sélection reste conservée même après une nouvelle recherche.
                    </small>

                </div>

            </div>


            <form method="GET"
                  action="{{ route('cards.reception') }}">

                <div class="row g-3">

                    <div class="col-lg-7">

                        <label class="form-label fw-semibold">
                            Recherche
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="N° carte, N° membre, nom, prénom ou téléphone...">

                        </div>

                    </div>


                    <div class="col-lg-3">

                        <label class="form-label fw-semibold">
                            Fédération
                        </label>

                        <select name="federation_id"
                                class="form-select">

                            <option value="">
                                Toutes les fédérations
                            </option>

                            @foreach($federations as $federation)

                                <option value="{{ $federation->id }}"
                                    {{ request('federation_id') == $federation->id ? 'selected' : '' }}>

                                    {{ $federation->sigle
                                        ? $federation->sigle . ' — ' . $federation->nom
                                        : $federation->nom }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-lg-2 d-flex align-items-end">

                        <div class="d-flex gap-2 w-100">

                            <button type="submit"
                                    class="btn btn-primary flex-grow-1">

                                <i class="bi bi-search me-1"></i>
                                Rechercher

                            </button>

                            @if(request('search') || request('federation_id'))

                                <a href="{{ route('cards.reception') }}"
                                   class="btn btn-outline-secondary"
                                   title="Réinitialiser">

                                    <i class="bi bi-arrow-counterclockwise"></i>

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- BARRE DE SÉLECTION --}}
    {{-- ===================================================== --}}

    <div id="selectionBar"
         class="selection-bar shadow-sm mb-4 d-none">

        <div class="d-flex align-items-center">

            <div class="selection-icon">
                <i class="bi bi-check2-square"></i>
            </div>

            <div class="ms-3">

                <strong id="selectionCount">
                    0 carte sélectionnée
                </strong>

                <div class="small text-muted">
                    Les cartes sélectionnées restent conservées pendant vos recherches.
                </div>

            </div>

        </div>


        <button type="button"
                id="clearSelection"
                class="btn btn-sm btn-outline-danger">

            <i class="bi bi-x-circle me-1"></i>
            Vider la sélection

        </button>

    </div>



    {{-- ===================================================== --}}
    {{-- LISTE --}}
    {{-- ===================================================== --}}

    <form id="receptionForm"
          method="POST"
          action="{{ route('cards.reception.store') }}">

        @csrf


        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">

                        <div class="list-icon me-3">
                            <i class="bi bi-person-vcard-fill"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Cartes produites à réceptionner
                            </h5>

                            <small class="text-muted">
                                {{ $cards->total() }}
                                carte{{ $cards->total() > 1 ? 's' : '' }}
                                disponible{{ $cards->total() > 1 ? 's' : '' }}
                            </small>

                        </div>

                    </div>


                    <button type="submit"
                            id="submitReception"
                            class="btn btn-success"
                            disabled>

                        <i class="bi bi-box-arrow-in-down me-1"></i>

                        Enregistrer la réception

                    </button>

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table reception-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="text-center select-column">

                                    <input type="checkbox"
                                           id="selectAll"
                                           class="form-check-input">

                                </th>

                                <th>
                                    Carte
                                </th>

                                <th>
                                    Membre
                                </th>

                                <th>
                                    Catégorie
                                </th>

                                <th>
                                    Fédération
                                </th>

                                <th>
                                    Production
                                </th>

                                <th>
                                    État
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($cards as $card)

                                <tr>

                                    <td class="text-center">

                                        <input type="checkbox"
                                               class="form-check-input card-checkbox"
                                               value="{{ $card->id }}"
                                               data-card-id="{{ $card->id }}">

                                    </td>


                                    <td>

                                        <div class="card-number">
                                            {{ $card->numero_carte }}
                                        </div>

                                        <small class="text-muted">
                                            <i class="bi bi-qr-code me-1"></i>
                                            QR sécurisé
                                        </small>

                                    </td>


                                    <td>

                                        <div class="member-name">

                                            {{ $card->member->nom }}
                                            {{ $card->member->postnom }}
                                            {{ $card->member->prenom }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $card->member->numero_membre }}

                                        </small>

                                    </td>


                                    <td>

                                        {{ $card->member->category->nom ?? '—' }}

                                    </td>


                                    <td>

                                        @if($card->member->federation)

                                            <span class="federation-badge">

                                                {{ $card->member->federation->sigle
                                                    ?? $card->member->federation->nom }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <span class="production-badge">

                                            <i class="bi bi-check-circle-fill"></i>

                                            Produite

                                        </span>

                                    </td>


                                    <td>

                                        <span class="waiting-badge">

                                            <i class="bi bi-hourglass-split"></i>

                                            À réceptionner

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7"
                                        class="empty-state">

                                        <div class="empty-icon">

                                            <i class="bi bi-inbox"></i>

                                        </div>

                                        <h6 class="fw-bold mt-3">
                                            Aucune carte à réceptionner
                                        </h6>

                                        <p class="text-muted mb-0">
                                            Toutes les cartes produites ont déjà été reçues par l’UNEAC.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            @if($cards->hasPages())

                <div class="card-footer bg-white border-0 py-3">

                    {{ $cards->links() }}

                </div>

            @endif

        </div>

    </form>

</div>

@endsection



@section('css')

<style>

    body {
        background: #f5f7f6;
    }


    .reception-banner {
        border-left: 4px solid #087f3f !important;
    }


    .page-icon,
    .filter-icon,
    .list-icon {

        width: 46px;
        height: 46px;

        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e9f7ef;

        color: #087f3f;

        font-size: 21px;

    }


    .process-info {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 8px;

        font-size: 11px;

        color: #7b858c;

    }


    .process-item {

        display: flex;

        align-items: center;

        gap: 5px;

        white-space: nowrap;

    }


    .process-item span {

        width: 24px;
        height: 24px;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e9ecef;

        font-weight: 700;

    }


    .process-item.active span {

        background: #e9f7ef;
        color: #087f3f;

    }


    .process-item.current {

        color: #087f3f;
        font-weight: 700;

    }


    .process-item.current span {

        background: #087f3f;
        color: white;

    }


    .selection-bar {

        background: white;

        border: 1px solid #cfe9d9;

        border-left: 4px solid #087f3f;

        border-radius: 9px;

        padding: 12px 16px;

        display: flex;

        align-items: center;

        justify-content: space-between;

    }


    .selection-icon {

        width: 38px;
        height: 38px;

        border-radius: 9px;

        background: #e9f7ef;

        color: #087f3f;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 18px;

    }


    .reception-table thead th {

        background: #f8faf9;

        text-transform: uppercase;

        font-size: 11px;

        letter-spacing: .035em;

        color: #59636a;

        padding: 14px;

        border-bottom: 1px solid #e9ecef;

        white-space: nowrap;

    }


    .reception-table tbody td {

        padding: 14px;

        border-bottom: 1px solid #f0f2f3;

    }


    .reception-table tbody tr:hover td {

        background: #fbfdfc;

    }


    .select-column {

        width: 55px;

    }


    .form-check-input {

        width: 18px;
        height: 18px;

        cursor: pointer;

    }


    .form-check-input:checked {

        background-color: #087f3f;

        border-color: #087f3f;

    }


    .card-number {

        font-weight: 700;

        color: #087f3f;

        font-size: 13px;

    }


    .member-name {

        font-weight: 600;

        color: #212529;

    }


    .federation-badge {

        display: inline-block;

        padding: 5px 9px;

        background: #f3f5f4;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 700;

    }


    .production-badge,
    .waiting-badge {

        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 6px 9px;

        border-radius: 7px;

        font-size: 11px;

        font-weight: 600;

        white-space: nowrap;

    }


    .production-badge {

        color: #087f3f;

        background: #e9f7ef;

    }


    .waiting-badge {

        color: #996c00;

        background: #fff5d9;

    }


    .empty-state {

        text-align: center;

        padding: 65px 20px !important;

    }


    .empty-icon {

        width: 65px;
        height: 65px;

        margin: auto;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e9f7ef;

        color: #087f3f;

        font-size: 28px;

    }


    @media(max-width: 992px) {

        .process-info {

            justify-content: flex-start;

        }

    }

</style>

@stop



@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const storageKey = 'uneac_reception_selection';

    const form = document.getElementById('receptionForm');

    const checkboxes = document.querySelectorAll('.card-checkbox');

    const selectAll = document.getElementById('selectAll');

    const selectionBar = document.getElementById('selectionBar');

    const selectionCount = document.getElementById('selectionCount');

    const submitButton = document.getElementById('submitReception');

    const clearButton = document.getElementById('clearSelection');


    let selectedCards = JSON.parse(
        sessionStorage.getItem(storageKey) || '[]'
    );


    selectedCards = selectedCards.map(String);


    function saveSelection() {

        sessionStorage.setItem(
            storageKey,
            JSON.stringify(selectedCards)
        );

    }


    function updateInterface() {

        const selectedCount = selectedCards.length;


        selectionBar.classList.toggle(
            'd-none',
            selectedCount === 0
        );


        submitButton.disabled = selectedCount === 0;


        if (selectedCount === 1) {

            selectionCount.textContent =
                '1 carte sélectionnée';

        } else {

            selectionCount.textContent =
                selectedCount + ' cartes sélectionnées';

        }


        checkboxes.forEach(function (checkbox) {

            checkbox.checked = selectedCards.includes(
                String(checkbox.value)
            );

        });


        const visibleCheckboxes =
            Array.from(checkboxes);


        const checkedVisible =
            visibleCheckboxes.filter(
                checkbox => checkbox.checked
            ).length;


        if (selectAll) {

            selectAll.checked =
                visibleCheckboxes.length > 0 &&
                checkedVisible === visibleCheckboxes.length;

            selectAll.indeterminate =
                checkedVisible > 0 &&
                checkedVisible < visibleCheckboxes.length;

        }

    }


    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener('change', function () {

            const id = String(this.value);


            if (this.checked) {

                if (!selectedCards.includes(id)) {

                    selectedCards.push(id);

                }

            } else {

                selectedCards =
                    selectedCards.filter(
                        cardId => cardId !== id
                    );

            }


            saveSelection();

            updateInterface();

        });

    });


    if (selectAll) {

        selectAll.addEventListener('change', function () {

            checkboxes.forEach(function (checkbox) {

                const id = String(checkbox.value);


                if (selectAll.checked) {

                    checkbox.checked = true;

                    if (!selectedCards.includes(id)) {

                        selectedCards.push(id);

                    }

                } else {

                    checkbox.checked = false;

                    selectedCards =
                        selectedCards.filter(
                            cardId => cardId !== id
                        );

                }

            });


            saveSelection();

            updateInterface();

        });

    }


    clearButton.addEventListener('click', function () {

        Swal.fire({

            title: 'Vider la sélection ?',

            text: 'Toutes les cartes actuellement sélectionnées seront désélectionnées.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Oui, vider',

            cancelButtonText: 'Annuler',

            reverseButtons: true,

            confirmButtonColor: '#dc3545'

        }).then(function (result) {

            if (result.isConfirmed) {

                selectedCards = [];

                saveSelection();

                updateInterface();

            }

        });

    });


    form.addEventListener('submit', function (event) {

        event.preventDefault();


        if (selectedCards.length === 0) {

            Swal.fire({

                icon: 'warning',

                title: 'Aucune carte sélectionnée',

                text: 'Sélectionnez au moins une carte.'

            });

            return;

        }


        Swal.fire({

            title: 'Confirmer la réception',

            html:
                '<strong>' +
                selectedCards.length +
                '</strong> carte(s) seront enregistrée(s) comme reçue(s) par l’UNEAC.',

            icon: 'question',

            showCancelButton: true,

            confirmButtonText: 'Confirmer',

            cancelButtonText: 'Annuler',

            reverseButtons: true,

            confirmButtonColor: '#087f3f'

        }).then(function (result) {

            if (!result.isConfirmed) {
                return;
            }


            /*
             * Supprime les anciens champs générés.
             */
            form.querySelectorAll(
                'input[data-selection-hidden="true"]'
            ).forEach(function (input) {

                input.remove();

            });


            /*
             * Ajoute toutes les cartes sélectionnées.
             */
            selectedCards.forEach(function (id) {

                const input =
                    document.createElement('input');

                input.type = 'hidden';

                input.name = 'cards[]';

                input.value = id;

                input.dataset.selectionHidden = 'true';

                form.appendChild(input);

            });


            /*
             * On garde la sélection jusqu'à ce que
             * le serveur confirme la réussite.
             */
            form.submit();

        });

    });


    /*
     * Si l'opération précédente a réussi,
     * on nettoie la sélection.
     */
    @if(session('success'))

        sessionStorage.removeItem(storageKey);

    @endif


    updateInterface();

});

</script>

@stop
