{{-- ============================================================= --}}
{{-- MODAL MODIFIER UNE FÉDÉRATION --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalModifierFederation{{ $federation->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierFederationLabel{{ $federation->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- ================================================= --}}
            {{-- EN-TÊTE --}}
            {{-- ================================================= --}}

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalModifierFederationLabel{{ $federation->id }}">

                    <i class="bi bi-pencil-square me-2 text-warning"></i>

                    Modifier la fédération

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

            <form action="{{ route('federations.update', $federation) }}"
                  method="POST">

                @csrf

                @method('PUT')

                <div class="modal-body">

                    {{-- NOM --}}
                    <div class="mb-3">

                        <label for="nomFederation{{ $federation->id }}"
                               class="form-label fw-semibold">

                            Nom de la fédération

                            <span class="text-danger">*</span>

                        </label>

                        <input type="text"
                               name="nom"
                               id="nomFederation{{ $federation->id }}"
                               class="form-control"
                               value="{{ $federation->nom }}"
                               placeholder="Ex. Fédération des Écrivains Congolais"
                               required>

                    </div>


                    {{-- SIGLE --}}
                    <div class="mb-3">

                        <label for="sigleFederation{{ $federation->id }}"
                               class="form-label fw-semibold">

                            Sigle

                        </label>

                        <input type="text"
                               name="sigle"
                               id="sigleFederation{{ $federation->id }}"
                               class="form-control"
                               value="{{ $federation->sigle }}"
                               placeholder="Ex. FECOL">

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mb-3">

                        <label for="descriptionFederation{{ $federation->id }}"
                               class="form-label fw-semibold">

                            Description

                        </label>

                        <textarea name="description"
                                  id="descriptionFederation{{ $federation->id }}"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Décrivez cette fédération...">{{ $federation->description }}</textarea>

                    </div>


                    {{-- STATUT --}}
                    <div class="form-check form-switch">

                        <input type="hidden"
                               name="active"
                               value="0">

                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               name="active"
                               value="1"
                               id="activeFederation{{ $federation->id }}"
                               {{ $federation->active ? 'checked' : '' }}>

                        <label class="form-check-label fw-semibold"
                               for="activeFederation{{ $federation->id }}">

                            Fédération active

                        </label>

                    </div>

                    <small class="text-muted">

                        Désactivez cette option si cette fédération
                        ne doit plus être utilisée.

                    </small>

                </div>


                {{-- ================================================= --}}
                {{-- PIED DU MODAL --}}
                {{-- ================================================= --}}

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="bi bi-x-lg me-1"></i>

                        Annuler

                    </button>


                    <button type="submit"
                            class="btn btn-warning">

                        <i class="bi bi-check-lg me-1"></i>

                        Enregistrer les modifications

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
