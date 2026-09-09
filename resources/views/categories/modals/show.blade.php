{{-- ============================================================= --}}
{{-- MODAL VOIR UNE CATÉGORIE --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalVoirCategorie{{ $category->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirCategorieLabel{{ $category->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
    >

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- EN-TÊTE --}}
            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalVoirCategorieLabel{{ $category->id }}">

                    <i class="bi bi-eye me-2 text-info"></i>

                    Détails de la catégorie

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- CONTENU --}}
            <div class="modal-body">

                <div class="row g-4">

                    {{-- NOM --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Nom de la catégorie
                            </small>

                            <h5 class="mb-0 fw-bold">

                                <i class="bi bi-tag text-primary me-2"></i>

                                {{ $category->nom }}

                            </h5>

                        </div>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Statut
                            </small>

                            @if($category->active)

                                <span class="badge text-bg-success fs-6">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Active

                                </span>

                            @else

                                <span class="badge text-bg-danger fs-6">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Inactive

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-2">
                                Description
                            </small>

                            @if($category->description)

                                <p class="mb-0">
                                    {{ $category->description }}
                                </p>

                            @else

                                <span class="text-muted">
                                    Aucune description renseignée.
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- NOMBRE DE MEMBRES --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Membres associés
                            </small>

                            <h5 class="mb-0">

                                <i class="bi bi-people text-primary me-2"></i>

                                {{ $category->members_count ?? $category->members()->count() }}

                                membre(s)

                            </h5>

                        </div>

                    </div>


                    {{-- DATE DE CRÉATION --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Date de création
                            </small>

                            <h6 class="mb-0">

                                <i class="bi bi-calendar3 text-primary me-2"></i>

                                {{ $category->created_at?->format('d/m/Y à H:i') }}

                            </h6>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PIED --}}
            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    <i class="bi bi-x-lg me-1"></i>

                    Fermer

                </button>


                <button type="button"
                        class="btn btn-warning"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierCategorie{{ $category->id }}">

                    <i class="bi bi-pencil-square me-1"></i>

                    Modifier

                </button>

            </div>

        </div>

    </div>

</div>
