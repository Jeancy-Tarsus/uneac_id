<div class="modal fade"
     id="modalAjouterCarte"
     tabindex="-1"
     aria-labelledby="modalAjouterCarteLabel"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            {{-- ================================================= --}}
            {{-- EN-TÊTE --}}
            {{-- ================================================= --}}

            <div class="modal-header">

                <h5 class="modal-title fw-bold"
                    id="modalAjouterCarteLabel">

                    <i class="bi bi-person-vcard-fill text-primary me-2"></i>

                    Nouvelle carte de membre

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- ================================================= --}}
            {{-- FORMULAIRE --}}
            {{-- ================================================= --}}

            <form method="POST"
                  action="{{ route('cards.store') }}">

                @csrf


                {{-- CORPS --}}

                <div class="modal-body"
                     style="max-height: 65vh; overflow-y: auto;">


                    {{-- ================================================= --}}
                    {{-- INFORMATIONS DU MEMBRE --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-person me-2"></i>

                            Membre

                        </h6>


                        <div class="mb-3">

                            <label for="member_id"
                                   class="form-label fw-semibold">

                                Membre <span class="text-danger">*</span>

                            </label>

                            <select name="member_id"
                                    id="member_id"
                                    class="form-select @error('member_id') is-invalid @enderror"
                                    required>

                                <option value="">
                                    Sélectionner un membre
                                </option>

                                @foreach(
                                    \App\Models\Member::with([
                                        'category',
                                        'federation'
                                    ])
                                    ->whereDoesntHave('card')
                                    ->orderBy('nom')
                                    ->orderBy('prenom')
                                    ->get()
                                    as $member
                                )

                                    <option value="{{ $member->id }}"
                                        {{ old('member_id') == $member->id ? 'selected' : '' }}>

                                        {{ $member->numero_membre }}
                                        —
                                        {{ $member->nom }}
                                        {{ $member->postnom }}
                                        {{ $member->prenom }}

                                        @if($member->category)
                                            ({{ $member->category->nom }})
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                            @error('member_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <small class="text-muted">
                                Seuls les membres ne possédant pas encore de carte sont affichés.
                            </small>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- VALIDITÉ DE LA CARTE --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-calendar3 me-2"></i>

                            Validité de la carte

                        </h6>


                        <div class="row g-3">


                            {{-- DATE DÉLIVRANCE --}}

                            <div class="col-md-6">

                                <label for="date_delivrance"
                                       class="form-label fw-semibold">

                                    Date de délivrance
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="date"
                                       name="date_delivrance"
                                       id="date_delivrance"
                                       class="form-control @error('date_delivrance') is-invalid @enderror"
                                       value="{{ old('date_delivrance', now()->format('Y-m-d')) }}"
                                       required>

                                @error('date_delivrance')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                           {{-- DATE D'EXPIRATION AUTOMATIQUE --}}

                            <div class="col-md-6">

                                <label for="date_expiration"
                                    class="form-label fw-semibold">

                                    Date d'expiration

                                </label>

                                <input type="date"
                                    id="date_expiration"
                                    class="form-control"
                                    value="{{ old('date_expiration', now()->addYear()->format('Y-m-d')) }}"
                                    readonly>

                                <small class="text-muted">
                                    La carte est valable pendant 1 année à compter de la date de délivrance.
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- STATUT --}}
                    {{-- ================================================= --}}

                    <div class="mb-3">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-shield-check me-2"></i>

                            Statut

                        </h6>


                        <div class="mb-3">

                            <label for="statut"
                                   class="form-label fw-semibold">

                                Statut de la carte
                                <span class="text-danger">*</span>

                            </label>

                            <select name="statut"
                                    id="statut"
                                    class="form-select @error('statut') is-invalid @enderror"
                                    required>

                                <option value="active"
                                    {{ old('statut', 'active') === 'active' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="expiree"
                                    {{ old('statut') === 'expiree' ? 'selected' : '' }}>

                                    Expirée

                                </option>

                                <option value="suspendue"
                                    {{ old('statut') === 'suspendue' ? 'selected' : '' }}>

                                    Suspendue

                                </option>

                                <option value="revoquee"
                                    {{ old('statut') === 'revoquee' ? 'selected' : '' }}>

                                    Révoquée

                                </option>

                            </select>

                            @error('statut')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="alert alert-info mb-0">

                        <div class="d-flex">

                            <i class="bi bi-info-circle-fill me-2"></i>

                            <div>

                                <strong>Génération automatique</strong>

                                <div class="small mt-1">

                                    Le numéro de carte et le QR token seront
                                    générés automatiquement lors de l'enregistrement.

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- PIED --}}
                {{-- ================================================= --}}

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="bi bi-x-lg me-1"></i>

                        Annuler

                    </button>


                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-lg me-1"></i>

                        Créer la carte

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const dateDelivrance = document.getElementById('date_delivrance');
    const dateExpiration = document.getElementById('date_expiration');

    function calculerExpiration() {

        if (!dateDelivrance.value) {
            return;
        }

        const date = new Date(dateDelivrance.value + 'T00:00:00');

        date.setFullYear(date.getFullYear() + 1);

        const annee = date.getFullYear();
        const mois = String(date.getMonth() + 1).padStart(2, '0');
        const jour = String(date.getDate()).padStart(2, '0');

        dateExpiration.value = `${annee}-${mois}-${jour}`;
    }

    dateDelivrance.addEventListener('change', calculerExpiration);

    calculerExpiration();

});
</script>
