<div class="modal fade"
     id="modalModifierCarte{{ $card->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierCarteLabel{{ $card->id }}"
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
                    id="modalModifierCarteLabel{{ $card->id }}">

                    <i class="bi bi-pencil-square text-warning me-2"></i>

                    Modifier la carte

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
                  action="{{ route('cards.update', $card) }}">

                @csrf
                @method('PUT')


                {{-- ================================================= --}}
                {{-- CORPS --}}
                {{-- ================================================= --}}

                <div class="modal-body"
                     style="max-height: 65vh; overflow-y: auto;">


                    {{-- ================================================= --}}
                    {{-- IDENTIFICATION --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-person-vcard me-2"></i>

                            Identification de la carte

                        </h6>


                        <div class="row g-3">

                            {{-- NUMÉRO CARTE --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Numéro de carte
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $card->numero_carte }}"
                                       readonly>

                                <small class="text-muted">
                                    Le numéro de carte ne peut pas être modifié.
                                </small>

                            </div>


                            {{-- NUMÉRO MEMBRE --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Numéro membre
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $card->member->numero_membre }}"
                                       readonly>

                            </div>


                            {{-- NOM DU MEMBRE --}}

                            <div class="col-md-12">

                                <label class="form-label fw-semibold">
                                    Membre
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $card->member->nom }}
                                               {{ $card->member->postnom }}
                                               {{ $card->member->prenom }}"
                                       readonly>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- VALIDITÉ --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-calendar3 me-2"></i>

                            Validité de la carte

                        </h6>


                        <div class="row g-3">

                            {{-- DATE DÉLIVRANCE --}}

                            <div class="col-md-6">

                                <label for="date_delivrance_{{ $card->id }}"
                                       class="form-label fw-semibold">

                                    Date de délivrance
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="date"
                                       name="date_delivrance"
                                       id="date_delivrance_{{ $card->id }}"
                                       class="form-control @error('date_delivrance') is-invalid @enderror"
                                       value="{{ old('date_delivrance', $card->date_delivrance?->format('Y-m-d')) }}"
                                       required>

                                @error('date_delivrance')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- DATE D'EXPIRATION AUTOMATIQUE --}}

                            <div class="col-md-6">

                                <label for="date_expiration_{{ $card->id }}"
                                    class="form-label fw-semibold">

                                    Date d'expiration

                                </label>

                                <input type="date"
                                    id="date_expiration_{{ $card->id }}"
                                    class="form-control"
                                    value="{{ $card->date_delivrance?->copy()->addYear()->format('Y-m-d') }}"
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

                    <div class="mb-4">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-shield-check me-2"></i>

                            Statut de la carte

                        </h6>


                        <div class="row">

                            <div class="col-md-6">

                                <label for="statut_{{ $card->id }}"
                                       class="form-label fw-semibold">

                                    Statut
                                    <span class="text-danger">*</span>

                                </label>

                                <select name="statut"
                                        id="statut_{{ $card->id }}"
                                        class="form-select @error('statut') is-invalid @enderror"
                                        required>

                                    <option value="active"
                                        {{ old('statut', $card->statut) === 'active' ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="expiree"
                                        {{ old('statut', $card->statut) === 'expiree' ? 'selected' : '' }}>

                                        Expirée

                                    </option>

                                    <option value="suspendue"
                                        {{ old('statut', $card->statut) === 'suspendue' ? 'selected' : '' }}>

                                        Suspendue

                                    </option>

                                    <option value="revoquee"
                                        {{ old('statut', $card->statut) === 'revoquee' ? 'selected' : '' }}>

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

                    </div>


                    {{-- ================================================= --}}
                    {{-- QR TOKEN --}}
                    {{-- ================================================= --}}

                    <div class="mb-3">

                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">

                            <i class="bi bi-qr-code me-2"></i>

                            Vérification numérique

                        </h6>


                        <div class="alert alert-light border mb-0">

                            <div class="row g-3 align-items-center">

                                <div class="col-md-2 text-center">

                                    <i class="bi bi-qr-code fs-1 text-primary"></i>

                                </div>


                                <div class="col-md-10">

                                    <div class="small text-muted mb-1">
                                        Identifiant QR
                                    </div>

                                    <code class="small text-break">
                                        {{ $card->qr_token }}
                                    </code>

                                    <div class="small text-muted mt-2">

                                        Le QR token est permanent et ne sera pas
                                        modifié lors de la mise à jour de la carte.

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- AVERTISSEMENT --}}
                    {{-- ================================================= --}}

                    <div class="alert alert-warning mb-0">

                        <div class="d-flex">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            <div>

                                <strong>Attention</strong>

                                <div class="small mt-1">

                                    La modification du statut peut affecter
                                    immédiatement la vérification de cette carte
                                    via son QR Code.

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

                        Enregistrer les modifications

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const dateDelivrance = document.getElementById('date_delivrance_{{ $card->id }}');
    const dateExpiration = document.getElementById('date_expiration_{{ $card->id }}');

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

});
</script>
