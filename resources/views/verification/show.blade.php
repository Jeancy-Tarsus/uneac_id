<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Vérification UNEAC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm">

                {{-- EN-TÊTE --}}

                <div class="card-body text-center p-4">

                    <div class="mb-3">

                        <div class="rounded-circle bg-success bg-opacity-10
                                    d-inline-flex align-items-center
                                    justify-content-center"
                             style="width:80px;height:80px;">

                            <i class="bi bi-patch-check-fill text-success fs-1"></i>

                        </div>

                    </div>

                    <h3 class="fw-bold mb-1">
                        Vérification UNEAC
                    </h3>

                    <p class="text-muted mb-4">
                        Vérification de l'authenticité de la carte
                    </p>


                    {{-- STATUT --}}

                    @if($card->statut === 'active')

                        <div class="alert alert-success">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            <strong>CARTE VALIDE</strong>

                        </div>

                    @elseif($card->statut === 'expiree')

                        <div class="alert alert-warning">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            <strong>CARTE EXPIRÉE</strong>

                        </div>

                    @elseif($card->statut === 'suspendue')

                        <div class="alert alert-secondary">

                            <i class="bi bi-pause-circle-fill me-2"></i>

                            <strong>CARTE SUSPENDUE</strong>

                        </div>

                    @else

                        <div class="alert alert-danger">

                            <i class="bi bi-x-circle-fill me-2"></i>

                            <strong>CARTE RÉVOQUÉE</strong>

                        </div>

                    @endif


                    {{-- PHOTO --}}

                    @if($card->member->photo)

                        <img src="{{ asset('storage/' . $card->member->photo) }}"
                             alt="Photo du membre"
                             class="rounded-circle mb-3"
                             width="120"
                             height="120"
                             style="object-fit:cover;">

                    @else

                        <div class="rounded-circle bg-secondary
                                    text-white d-inline-flex
                                    align-items-center justify-content-center
                                    mb-3"
                             style="width:120px;height:120px;">

                            <i class="bi bi-person-fill fs-1"></i>

                        </div>

                    @endif


                    {{-- IDENTITÉ --}}

                    <h4 class="fw-bold mb-1">

                        {{ $card->member->nom }}
                        {{ $card->member->postnom }}
                        {{ $card->member->prenom }}

                    </h4>

                    <p class="text-muted">

                        {{ $card->member->profession_artistique ?? 'Membre UNEAC' }}

                    </p>


                    {{-- INFORMATIONS --}}

                    <div class="card bg-light border-0 text-start mt-4">

                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-6">

                                    <small class="text-muted d-block">
                                        N° membre
                                    </small>

                                    <strong>
                                        {{ $card->member->numero_membre }}
                                    </strong>

                                </div>

                                <div class="col-6">

                                    <small class="text-muted d-block">
                                        N° carte
                                    </small>

                                    <strong>
                                        {{ $card->numero_carte }}
                                    </strong>

                                </div>

                                <div class="col-6">

                                    <small class="text-muted d-block">
                                        Catégorie
                                    </small>

                                    <strong>
                                        {{ $card->member->category->nom ?? '—' }}
                                    </strong>

                                </div>

                                <div class="col-6">

                                    <small class="text-muted d-block">
                                        Fédération
                                    </small>

                                    <strong>
                                        {{ $card->member->federation->sigle
                                            ?? $card->member->federation->nom
                                            ?? '—' }}
                                    </strong>

                                </div>

                                <div class="col-6">

                                    <small class="text-muted d-block">
                                        Délivrée le
                                    </small>

                                    <strong>
                                        {{ $card->date_delivrance?->format('d/m/Y') }}
                                    </strong>

                                </div>

                                <div class="col-6">

                                    <small class="text-muted d-block">
                                        Expire le
                                    </small>

                                    <strong>
                                        {{ $card->date_expiration?->format('d/m/Y') }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="mt-4 text-muted small">

                        <i class="bi bi-shield-check me-1"></i>

                        Cette vérification est fournie par la plateforme
                        d'identification des membres de l'UNEAC.

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
