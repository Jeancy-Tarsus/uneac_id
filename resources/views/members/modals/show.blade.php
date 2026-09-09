<div class="modal fade"
     id="modalVoirMembre{{ $member->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirMembreLabel{{ $member->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">

            {{-- En-tête --}}
            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title"
                    id="modalVoirMembreLabel{{ $member->id }}">

                    <i class="bi bi-person-vcard-fill me-2"></i>
                    Profil du membre
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>

            <div class="modal-body">

                {{-- En-tête profil --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <div class="row align-items-center">

                            {{-- Photo --}}
                            <div class="col-md-3 text-center">

                                @if($member->photo)

                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                         alt="Photo de {{ $member->prenom }}"
                                         class="rounded-circle img-thumbnail"
                                         style="width: 150px; height: 150px; object-fit: cover;">

                                @else

                                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center border"
                                         style="width: 150px; height: 150px;">

                                        <i class="bi bi-person-fill text-secondary"
                                           style="font-size: 80px;">
                                        </i>

                                    </div>

                                @endif

                            </div>

                            {{-- Identité --}}
                            <div class="col-md-6">

                                <h3 class="fw-bold mb-1">
                                    {{ $member->nom }}
                                    {{ $member->postnom }}
                                    {{ $member->prenom }}
                                </h3>

                                <p class="text-muted mb-2">
                                    {{ $member->profession_artistique ?? 'Profession non renseignée' }}
                                </p>

                                <span class="badge
                                    @if($member->statut === 'actif')
                                        bg-success
                                    @elseif($member->statut === 'suspendu')
                                        bg-warning text-dark
                                    @else
                                        bg-secondary
                                    @endif">

                                    {{ ucfirst($member->statut) }}

                                </span>

                            </div>

                            {{-- Numéro --}}
                            <div class="col-md-3 text-md-end">

                                <small class="text-muted d-block">
                                    Numéro membre
                                </small>

                                <h5 class="fw-bold text-primary">
                                    {{ $member->numero_membre }}
                                </h5>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Informations personnelles --}}
                <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                    <i class="bi bi-person me-2"></i>
                    Informations personnelles
                </h6>

                <div class="row g-3 mb-4">

                    <div class="col-md-4">
                        <small class="text-muted d-block">Nom</small>
                        <strong>{{ $member->nom }}</strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Postnom</small>
                        <strong>{{ $member->postnom ?: '-' }}</strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Prénom</small>
                        <strong>{{ $member->prenom }}</strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Date de naissance</small>
                        <strong>
                            {{ $member->date_naissance?->format('d/m/Y') ?? '-' }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Sexe</small>
                        <strong>
                            @if($member->sexe === 'M')
                                Masculin
                            @elseif($member->sexe === 'F')
                                Féminin
                            @else
                                -
                            @endif
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Lieu de naissance</small>
                        <strong>{{ $member->lieu_naissance ?: '-' }}</strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Nationalité</small>
                        <strong>{{ $member->nationalite ?: '-' }}</strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Téléphone</small>
                        <strong>{{ $member->telephone ?: '-' }}</strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">Email</small>
                        <strong>{{ $member->email ?: '-' }}</strong>
                    </div>

                    <div class="col-md-12">
                        <small class="text-muted d-block">Domicile</small>
                        <strong>{{ $member->domicile ?: '-' }}</strong>
                    </div>

                </div>


                {{-- Informations artistiques --}}
                <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                    <i class="bi bi-palette me-2"></i>
                    Informations artistiques
                </h6>

                <div class="row g-3 mb-4">

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Profession artistique
                        </small>

                        <strong>
                            {{ $member->profession_artistique ?: '-' }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Catégorie
                        </small>

                        <strong>
                            {{ $member->category?->nom ?? '-' }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Fédération
                        </small>

                        <strong>
                            {{ $member->federation?->nom ?? '-' }}
                        </strong>
                    </div>

                </div>


                {{-- Adhésion --}}
                <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                    <i class="bi bi-card-checklist me-2"></i>
                    Adhésion
                </h6>

                <div class="row g-3">

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Date d'adhésion
                        </small>

                        <strong>
                            {{ $member->date_adhesion?->format('d/m/Y') ?? '-' }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Statut du membre
                        </small>

                        <strong>
                            {{ ucfirst($member->statut) }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Carte
                        </small>

                        @if($member->card)

                            <span class="badge bg-success">
                                Carte disponible
                            </span>

                            <small class="d-block mt-1">
                                {{ $member->card->numero_carte }}
                            </small>

                        @else

                            <span class="badge bg-secondary">
                                Aucune carte
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Pied --}}
            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    <i class="bi bi-x-lg me-1"></i>
                    Fermer

                </button>

                <button type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierMembre{{ $member->id }}">

                    <i class="bi bi-pencil-square me-1"></i>
                    Modifier

                </button>

            </div>

        </div>
    </div>
</div>
