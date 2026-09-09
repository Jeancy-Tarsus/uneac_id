{{-- ============================================================= --}}
{{-- MODAL VOIR UNE FÉDÉRATION --}}
{{-- ============================================================= --}}

<div class="modal fade"
     id="modalVoirFederation{{ $federation->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirFederationLabel{{ $federation->id }}"
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
                    id="modalVoirFederationLabel{{ $federation->id }}">

                    <i class="bi bi-eye me-2 text-info"></i>

                    Détails de la fédération

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- ================================================= --}}
            {{-- CONTENU --}}
            {{-- ================================================= --}}

            <div class="modal-body">

                <div class="row g-4">

                    {{-- NOM --}}
                    <div class="col-md-8">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Nom de la fédération
                            </small>

                            <h5 class="mb-0 fw-bold">

                                <i class="bi bi-diagram-3 text-primary me-2"></i>

                                {{ $federation->nom }}

                            </h5>

                        </div>

                    </div>


                    {{-- SIGLE --}}
                    <div class="col-md-4">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Sigle
                            </small>

                            @if($federation->sigle)

                                <span class="badge text-bg-secondary fs-6">

                                    {{ $federation->sigle }}

                                </span>

                            @else

                                <span class="text-muted">
                                    Non renseigné
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

                            @if($federation->description)

                                <p class="mb-0">
                                    {{ $federation->description }}
                                </p>

                            @else

                                <span class="text-muted">
                                    Aucune description renseignée.
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- MEMBRES --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Membres associés
                            </small>

                            <h5 class="mb-0">

                                <i class="bi bi-people text-primary me-2"></i>

                                {{ $federation->members_count ?? $federation->members()->count() }}

                                membre(s)

                            </h5>

                        </div>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-2">
                                Statut
                            </small>

                            @if($federation->active)

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


                    {{-- DATE CRÉATION --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Date de création
                            </small>

                            <h6 class="mb-0">

                                <i class="bi bi-calendar3 text-primary me-2"></i>

                                {{ $federation->created_at?->format('d/m/Y à H:i') }}

                            </h6>

                        </div>

                    </div>


                    {{-- DERNIÈRE MODIFICATION --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Dernière modification
                            </small>

                            <h6 class="mb-0">

                                <i class="bi bi-clock-history text-primary me-2"></i>

                                {{ $federation->updated_at?->format('d/m/Y à H:i') }}

                            </h6>

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

                    Fermer

                </button>


                <button type="button"
                        class="btn btn-warning"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierFederation{{ $federation->id }}">

                    <i class="bi bi-pencil-square me-1"></i>

                    Modifier

                </button>

            </div>

        </div>

    </div>

</div>
