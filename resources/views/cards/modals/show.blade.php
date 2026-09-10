<div class="modal fade"
     id="modalVoirCarte{{ $card->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirCarteLabel{{ $card->id }}"
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
                    id="modalVoirCarteLabel{{ $card->id }}">

                    <i class="bi bi-person-vcard-fill text-primary me-2"></i>

                    Détails de la carte

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- ================================================= --}}
            {{-- CORPS --}}
            {{-- ================================================= --}}

            <div class="modal-body"
                 style="max-height: 70vh; overflow-y: auto;">

                {{-- ================================================= --}}
                {{-- IDENTIFICATION DE LA CARTE --}}
                {{-- ================================================= --}}

                <div class="text-center mb-4">

                    <div class="mb-2">

                        <span class="badge text-bg-primary fs-6 px-3 py-2">

                            {{ $card->numero_carte }}

                        </span>

                    </div>

                    <small class="text-muted">
                        Numéro unique de la carte
                    </small>

                </div>


                {{-- ================================================= --}}
                {{-- INFORMATIONS DU MEMBRE --}}
                {{-- ================================================= --}}

                <div class="card border mb-3">

                    <div class="card-header bg-body-tertiary">

                        <h6 class="mb-0 fw-bold">

                            <i class="bi bi-person me-2 text-primary"></i>

                            Informations du membre

                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- PHOTO --}}

                            <div class="col-md-3 text-center">

                                @if($card->member->photo)

                                    <img src="{{ asset('storage/' . $card->member->photo) }}"
                                         alt="Photo du membre"
                                         class="rounded"
                                         width="110"
                                         height="130"
                                         style="object-fit: cover;">

                                @else

                                    <div class="bg-body-secondary rounded
                                                d-flex align-items-center
                                                justify-content-center mx-auto"
                                         style="width:110px;height:130px;">

                                        <i class="bi bi-person-fill fs-1 text-muted"></i>

                                    </div>

                                @endif

                            </div>


                            {{-- INFORMATIONS --}}

                            <div class="col-md-9">

                                <div class="row g-3">

                                    {{-- NUMÉRO MEMBRE --}}

                                    <div class="col-md-6">

                                        <small class="text-muted d-block">
                                            Numéro membre
                                        </small>

                                        <span class="fw-semibold">

                                            {{ $card->member->numero_membre }}

                                        </span>

                                    </div>


                                    {{-- NOM COMPLET --}}

                                    <div class="col-md-6">

                                        <small class="text-muted d-block">
                                            Nom complet
                                        </small>

                                        <span class="fw-semibold">

                                            {{ $card->member->nom }}
                                            {{ $card->member->postnom }}
                                            {{ $card->member->prenom }}

                                        </span>

                                    </div>


                                    {{-- CATÉGORIE --}}

                                    <div class="col-md-6">

                                        <small class="text-muted d-block">
                                            Catégorie
                                        </small>

                                        <span>

                                            {{ $card->member->category->nom ?? '—' }}

                                        </span>

                                    </div>


                                    {{-- FÉDÉRATION --}}

                                    <div class="col-md-6">

                                        <small class="text-muted d-block">
                                            Fédération
                                        </small>

                                        <span>

                                            {{ $card->member->federation->sigle
                                                ?? $card->member->federation->nom
                                                ?? '—' }}

                                        </span>

                                    </div>


                                    {{-- PROFESSION --}}

                                    <div class="col-md-6">

                                        <small class="text-muted d-block">
                                            Profession artistique
                                        </small>

                                        <span>

                                            {{ $card->member->profession_artistique ?? '—' }}

                                        </span>

                                    </div>


                                    {{-- TÉLÉPHONE --}}

                                    <div class="col-md-6">

                                        <small class="text-muted d-block">
                                            Téléphone
                                        </small>

                                        <span>

                                            {{ $card->member->telephone ?? '—' }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- INFORMATIONS DE LA CARTE --}}
                {{-- ================================================= --}}

                <div class="card border mb-3">

                    <div class="card-header bg-body-tertiary">

                        <h6 class="mb-0 fw-bold">

                            <i class="bi bi-card-text me-2 text-primary"></i>

                            Informations de la carte

                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- NUMÉRO CARTE --}}

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Numéro de carte
                                </small>

                                <span class="fw-semibold">

                                    {{ $card->numero_carte }}

                                </span>

                            </div>


                            {{-- STATUT --}}

                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Statut
                                </small>

                                @if($card->statut === 'active')

                                    <span class="badge text-bg-success">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Active

                                    </span>

                                @elseif($card->statut === 'expiree')

                                    <span class="badge text-bg-warning">

                                        <i class="bi bi-clock me-1"></i>

                                        Expirée

                                    </span>

                                @elseif($card->statut === 'suspendue')

                                    <span class="badge text-bg-secondary">

                                        <i class="bi bi-pause-circle me-1"></i>

                                        Suspendue

                                    </span>

                                @else

                                    <span class="badge text-bg-danger">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Révoquée

                                    </span>

                                @endif

                            </div>


                            {{-- DATE DÉLIVRANCE --}}

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Date de délivrance
                                </small>

                                <span class="fw-semibold">

                                    {{ $card->date_delivrance?->format('d/m/Y') }}

                                </span>

                            </div>


                            {{-- DATE EXPIRATION --}}

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Date d'expiration
                                </small>

                                <span class="fw-semibold">

                                    {{ $card->date_expiration?->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- QR CODE --}}
                {{-- ================================================= --}}

                <div class="card border mb-3">

                    <div class="card-header bg-body-tertiary">

                        <h6 class="mb-0 fw-bold">

                            <i class="bi bi-qr-code me-2 text-primary"></i>

                            QR Code de vérification

                        </h6>

                    </div>


                    <div class="card-body text-center">

                        {{-- QR CODE --}}

                        <div class="d-inline-block p-3 bg-white border rounded mb-3">

                            {!! QrCode::size(180)
                                ->margin(1)
                                ->generate(
                                    route(
                                        'verification.show',
                                        $card->qr_token
                                    )
                                )
                            !!}

                        </div>


                        <div class="fw-semibold mb-1">

                            Scanner pour vérifier la carte

                        </div>


                        <div class="small text-muted mb-3">

                            Le QR Code permet de vérifier
                            l'authenticité et le statut de la carte.

                        </div>


                        {{-- URL DE VÉRIFICATION --}}

                        <div class="alert alert-light border mb-0">

                            <small class="text-muted d-block mb-1">

                                Adresse de vérification

                            </small>

                            <code class="small text-break">

                                {{ route('verification.show', $card->qr_token) }}

                            </code>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SÉCURITÉ --}}
                {{-- ================================================= --}}

                <div class="alert alert-info mb-0">

                    <div class="d-flex">

                        <i class="bi bi-shield-check fs-4 me-3"></i>

                        <div>

                            <strong>Vérification numérique UNEAC</strong>

                            <div class="small mt-1">

                                Le QR Code est associé de manière unique
                                à cette carte. Le statut affiché lors de
                                la vérification correspond au statut actuel
                                enregistré dans le système.

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- PIED DU MODAL --}}
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
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierCarte{{ $card->id }}"
                        data-bs-dismiss="modal">

                    <i class="bi bi-pencil me-1"></i>

                    Modifier

                </button>

            </div>

        </div>

    </div>

</div>
