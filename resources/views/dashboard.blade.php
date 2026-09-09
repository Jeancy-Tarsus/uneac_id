@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-bold mb-1">Tableau de bord</h1>
            <p class="text-muted mb-0">
                Bienvenue dans la plateforme de gestion des membres UNEAC.
            </p>
        </div>

        <div>
            <span class="badge bg-success px-3 py-2">
                <i class="fas fa-circle me-1"></i>
                Système opérationnel
            </span>
        </div>
    </div>
@stop



@section('content')

<div class="p-4">
    <i class="fa-solid fa-users fa-2x"></i>
    <i class="fa-solid fa-id-card fa-2x"></i>
    <i class="fa-solid fa-qrcode fa-2x"></i>
</div>

    {{-- Statistiques --}}
    <div class="row">

        {{-- Membres --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Membres</p>
                            <h2 class="fw-bold mb-0">1 250</h2>
                        </div>

                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-success">
                            <i class="fas fa-arrow-up"></i>
                            12 nouveaux ce mois
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cartes actives --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Cartes actives</p>
                            <h2 class="fw-bold mb-0">1 180</h2>
                        </div>

                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-id-card fa-2x text-success"></i>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-success">
                            <i class="fas fa-check-circle"></i>
                            Membres actifs
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cartes expirées --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Cartes expirées</p>
                            <h2 class="fw-bold mb-0">45</h2>
                        </div>

                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-calendar-times fa-2x text-warning"></i>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            À renouveler
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cartes suspendues --}}
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Cartes suspendues</p>
                            <h2 class="fw-bold mb-0">25</h2>
                        </div>

                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-ban fa-2x text-danger"></i>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            Vérification requise
                        </small>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- Actions rapides --}}
    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-1">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Actions rapides
                    </h5>

                    <p class="text-muted small mb-0">
                        Accédez rapidement aux principales fonctionnalités.
                    </p>
                </div>

                <div class="card-body px-4 pb-4">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-primary w-100 py-3">
                                <i class="fas fa-user-plus fa-lg d-block mb-2"></i>
                                Nouveau membre
                            </a>
                        </div>

                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-id-card fa-lg d-block mb-2"></i>
                                Nouvelle carte
                            </a>
                        </div>

                        <div class="col-md-4 mb-3">
                            <a href="#" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-qrcode fa-lg d-block mb-2"></i>
                                Vérifier une carte
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- Informations système --}}
        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        UNEAC ID
                    </h5>
                </div>

                <div class="card-body px-4">

                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-shield-alt fa-2x text-success"></i>
                        </div>

                        <div>
                            <strong>Identification sécurisée</strong>
                            <br>
                            <small class="text-muted">
                                QR Code unique pour chaque carte
                            </small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-mobile-alt fa-2x text-primary"></i>
                        </div>

                        <div>
                            <strong>Vérification mobile</strong>
                            <br>
                            <small class="text-muted">
                                Scannez une carte avec un téléphone
                            </small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-database fa-2x text-warning"></i>
                        </div>

                        <div>
                            <strong>Données centralisées</strong>
                            <br>
                            <small class="text-muted">
                                Gestion des membres UNEAC
                            </small>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@stop
