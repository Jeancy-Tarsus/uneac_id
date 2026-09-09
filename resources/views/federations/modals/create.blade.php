{{-- ============================================================= --}}
{{-- MODAL AJOUTER UNE FÉDÉRATION --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalAjouterFederation"
     tabindex="-1"
     aria-labelledby="modalAjouterFederationLabel"
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
                    id="modalAjouterFederationLabel">

                    <i class="bi bi-diagram-3 me-2 text-primary"></i>

                    Nouvelle fédération

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

            <form action="{{ route('federations.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    {{-- NOM --}}
                    <div class="mb-3">

                        <label for="nomFederation"
                               class="form-label fw-semibold">

                            Nom de la fédération

                            <span class="text-danger">*</span>

                        </label>

                        <input type="text"
                               name="nom"
                               id="nomFederation"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}"
                               placeholder="Ex. Fédération des Écrivains Congolais"
                               required>

                        @error('nom')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- SIGLE --}}
                    <div class="mb-3">

                        <label for="sigleFederation"
                               class="form-label fw-semibold">

                            Sigle

                        </label>

                        <input type="text"
                               name="sigle"
                               id="sigleFederation"
                               class="form-control @error('sigle') is-invalid @enderror"
                               value="{{ old('sigle') }}"
                               placeholder="Ex. FECOL">

                        @error('sigle')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mb-3">

                        <label for="descriptionFederation"
                               class="form-label fw-semibold">

                            Description

                        </label>

                        <textarea name="description"
                                  id="descriptionFederation"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Décrivez cette fédération...">{{ old('description') }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

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
                               id="activeFederation"
                               checked>

                        <label class="form-check-label fw-semibold"
                               for="activeFederation">

                            Fédération active

                        </label>

                    </div>

                    <small class="text-muted">

                        Une fédération inactive ne sera plus proposée
                        pour les nouvelles adhésions.

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
                            class="btn btn-primary">

                        <i class="bi bi-check-lg me-1"></i>

                        Enregistrer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
