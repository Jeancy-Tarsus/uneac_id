{{-- ============================================================= --}}
{{-- MODAL MODIFIER UNE CATÉGORIE --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalModifierCategorie{{ $category->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierCategorieLabel{{ $category->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
    >

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- EN-TÊTE --}}
            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalModifierCategorieLabel{{ $category->id }}">

                    <i class="bi bi-pencil-square me-2 text-warning"></i>

                    Modifier la catégorie

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- FORMULAIRE --}}
            <form action="{{ route('categories.update', $category) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- NOM --}}
                    <div class="mb-3">

                        <label for="nom{{ $category->id }}"
                               class="form-label fw-semibold">

                            Nom de la catégorie
                            <span class="text-danger">*</span>

                        </label>

                        <input type="text"
                               name="nom"
                               id="nom{{ $category->id }}"
                               class="form-control"
                               value="{{ $category->nom }}"
                               placeholder="Ex. Écrivain"
                               required>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mb-3">

                        <label for="description{{ $category->id }}"
                               class="form-label fw-semibold">

                            Description

                        </label>

                        <textarea name="description"
                                  id="description{{ $category->id }}"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Décrivez cette catégorie...">{{ $category->description }}</textarea>

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
                               id="active{{ $category->id }}"
                               {{ $category->active ? 'checked' : '' }}>

                        <label class="form-check-label fw-semibold"
                               for="active{{ $category->id }}">

                            Catégorie active

                        </label>

                    </div>

                    <small class="text-muted">

                        Désactivez cette option si la catégorie ne doit plus
                        être utilisée.

                    </small>

                </div>


                {{-- PIED --}}
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
