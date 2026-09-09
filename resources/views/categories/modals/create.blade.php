{{-- ============================================================= --}}
{{-- MODAL AJOUTER UNE CATÉGORIE --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalAjouterCategorie"
     tabindex="-1"
     aria-labelledby="modalAjouterCategorieLabel"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- ================================================= --}}
            {{-- EN-TÊTE --}}
            {{-- ================================================= --}}

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalAjouterCategorieLabel">

                    <i class="bi bi-plus-circle me-2 text-primary"></i>

                    Nouvelle catégorie

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

            <form action="{{ route('categories.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    {{-- NOM --}}
                    <div class="mb-3">

                        <label for="nom" class="form-label fw-semibold">

                            Nom de la catégorie
                            <span class="text-danger">*</span>

                        </label>

                        <input type="text"
                               name="nom"
                               id="nom"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}"
                               placeholder="Ex. Écrivain"
                               required>

                        @error('nom')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mb-3">

                        <label for="description"
                               class="form-label fw-semibold">

                            Description

                        </label>

                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Décrivez cette catégorie...">{{ old('description') }}</textarea>

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
                               id="active"
                               checked>

                        <label class="form-check-label fw-semibold"
                               for="active">

                            Catégorie active

                        </label>

                    </div>

                    <small class="text-muted">
                        Une catégorie inactive ne sera plus proposée
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
