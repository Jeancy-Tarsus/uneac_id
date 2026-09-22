<div class="modal fade"
     id="modalModifierMembre{{ $member->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierMembreLabel{{ $member->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            {{-- ================================================= --}}
            {{-- HEADER --}}
            {{-- ================================================= --}}

            <div class="modal-header bg-primary text-white">

                <div>

                    <h5 class="modal-title mb-0"
                        id="modalModifierMembreLabel{{ $member->id }}">

                        <i class="bi bi-pencil-square me-2"></i>

                        Modifier le membre

                    </h5>

                    <small class="opacity-75">

                        Modification des informations du membre UNEAC

                    </small>

                </div>


                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>


            {{-- ================================================= --}}
            {{-- ERREURS --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div class="alert alert-danger mx-4 mt-3 mb-0">

                    <div class="fw-bold mb-2">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        Impossible de modifier le membre

                    </div>

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- FORMULAIRE --}}
            {{-- ================================================= --}}

            <form action="{{ route('members.update', $member) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @method('PUT')


                {{-- ================================================= --}}
                {{-- BODY --}}
                {{-- ================================================= --}}

                <div class="modal-body"
                     style="max-height: 65vh; overflow-y: auto;">


                    {{-- ================================================= --}}
                    {{-- IDENTIFICATION --}}
                    {{-- ================================================= --}}

                    <div class="d-flex align-items-center mb-3">

                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">

                            <i class="bi bi-person-vcard text-primary fs-5"></i>

                        </div>

                        <div>

                            <h6 class="fw-bold mb-0">

                                Informations personnelles

                            </h6>

                            <small class="text-muted">

                                Identité et coordonnées du membre

                            </small>

                        </div>

                    </div>


                    {{-- NUMÉRO MEMBRE --}}
                    <div class="alert alert-primary d-flex align-items-center mb-4">

                        <i class="bi bi-person-badge fs-4 me-3"></i>

                        <div>

                            <small class="d-block">
                                Numéro de membre
                            </small>

                            <strong>
                                {{ $member->numero_membre }}
                            </strong>

                        </div>

                    </div>


                    <div class="row g-3">


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Nom
                                <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="nom"
                                   class="form-control @error('nom') is-invalid @enderror"
                                   value="{{ old('nom', $member->nom) }}"
                                   required>

                            @error('nom')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- PRÉNOM --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Prénom
                                <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="prenom"
                                   class="form-control @error('prenom') is-invalid @enderror"
                                   value="{{ old('prenom', $member->prenom) }}"
                                   required>

                            @error('prenom')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DATE NAISSANCE --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Date de naissance

                            </label>

                            <input type="date"
                                   name="date_naissance"
                                   class="form-control"
                                   value="{{ old(
                                       'date_naissance',
                                       $member->date_naissance?->format('Y-m-d')
                                   ) }}">

                        </div>


                        {{-- SEXE --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Sexe
                            </label>

                            <select name="sexe"
                                    class="form-select">

                                <option value="">
                                    -- Sélectionner --
                                </option>

                                <option value="M"
                                    {{ old('sexe', $member->sexe) === 'M' ? 'selected' : '' }}>

                                    Masculin

                                </option>

                                <option value="F"
                                    {{ old('sexe', $member->sexe) === 'F' ? 'selected' : '' }}>

                                    Féminin

                                </option>

                            </select>

                        </div>


                        {{-- LIEU NAISSANCE --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Lieu de naissance

                            </label>

                            <input type="text"
                                   name="lieu_naissance"
                                   class="form-control"
                                   value="{{ old(
                                       'lieu_naissance',
                                       $member->lieu_naissance
                                   ) }}">

                        </div>


                        {{-- NATIONALITÉ --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Nationalité

                            </label>

                            <input type="text"
                                   name="nationalite"
                                   class="form-control"
                                   value="{{ old(
                                       'nationalite',
                                       $member->nationalite
                                   ) }}">

                        </div>


                        {{-- TÉLÉPHONE --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Téléphone

                            </label>

                            <input type="text"
                                   name="telephone"
                                   class="form-control"
                                   value="{{ old(
                                       'telephone',
                                       $member->telephone
                                   ) }}">

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Email

                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old(
                                       'email',
                                       $member->email
                                   ) }}">

                            @error('email')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DOMICILE --}}
                        <div class="col-md-8">

                            <label class="form-label fw-semibold">

                                Domicile

                            </label>

                            <textarea name="domicile"
                                      class="form-control"
                                      rows="2">{{ old(
                                          'domicile',
                                          $member->domicile
                                      ) }}</textarea>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- ================================================= --}}
                    {{-- PHOTO --}}
                    {{-- ================================================= --}}

                    <div class="d-flex align-items-center mb-3">

                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">

                            <i class="bi bi-camera text-primary fs-5"></i>

                        </div>

                        <div>

                            <h6 class="fw-bold mb-0">

                                Photo du membre

                            </h6>

                            <small class="text-muted">

                                Photo utilisée pour la carte UNEAC

                            </small>

                        </div>

                    </div>


                    <div class="row align-items-center g-3">


                        {{-- PHOTO ACTUELLE --}}
                        <div class="col-md-3 text-center">

                            @if($member->photo)

                                <img src="{{ asset('storage/' . $member->photo) }}"
                                     alt="Photo de {{ $member->prenom }}"
                                     class="img-thumbnail rounded"
                                     style="width:130px;
                                            height:130px;
                                            object-fit:cover;">

                                <div class="small text-muted mt-2">

                                    Photo actuelle

                                </div>

                            @else

                                <div class="bg-light border rounded
                                            d-flex align-items-center
                                            justify-content-center mx-auto"
                                     style="width:130px;height:130px;">

                                    <i class="bi bi-person-fill
                                              text-secondary"
                                       style="font-size:60px;">
                                    </i>

                                </div>

                                <div class="small text-muted mt-2">

                                    Aucune photo

                                </div>

                            @endif

                        </div>


                        {{-- NOUVELLE PHOTO --}}
                        <div class="col-md-9">

                            <label class="form-label fw-semibold">

                                Remplacer la photo

                            </label>

                            <input type="file"
                                   name="photo"
                                   class="form-control @error('photo') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/jpg">

                            @error('photo')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                            <small class="text-muted d-block mt-2">

                                JPG, JPEG ou PNG — maximum 10 Mo.

                                Laissez vide pour conserver la photo actuelle.

                            </small>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- ================================================= --}}
                    {{-- INFORMATIONS ARTISTIQUES --}}
                    {{-- ================================================= --}}

                    <div class="d-flex align-items-center mb-3">

                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">

                            <i class="bi bi-palette text-primary fs-5"></i>

                        </div>

                        <div>

                            <h6 class="fw-bold mb-0">

                                Informations artistiques

                            </h6>

                            <small class="text-muted">

                                Domaine artistique et appartenance

                            </small>

                        </div>

                    </div>


                    <div class="row g-3">


                        {{-- PROFESSION --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Profession artistique

                            </label>

                            <input type="text"
                                   name="profession_artistique"
                                   class="form-control"
                                   value="{{ old(
                                       'profession_artistique',
                                       $member->profession_artistique
                                   ) }}"
                                   placeholder="Ex : Écrivain">

                        </div>


                        {{-- CATÉGORIE --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Catégorie

                            </label>

                            <select name="category_id"
                                    class="form-select">

                                <option value="">
                                    -- Sélectionner --
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}"
                                        {{ old(
                                            'category_id',
                                            $member->category_id
                                        ) == $category->id ? 'selected' : '' }}>

                                        {{ $category->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- FÉDÉRATION --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Fédération

                            </label>

                            <select name="federation_id"
                                    class="form-select">

                                <option value="">
                                    -- Sélectionner --
                                </option>

                                @foreach($federations as $federation)

                                    <option value="{{ $federation->id }}"
                                        {{ old(
                                            'federation_id',
                                            $member->federation_id
                                        ) == $federation->id ? 'selected' : '' }}>

                                        {{ $federation->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- ================================================= --}}
                    {{-- ADHÉSION --}}
                    {{-- ================================================= --}}

                    <div class="d-flex align-items-center mb-3">

                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">

                            <i class="bi bi-card-checklist text-primary fs-5"></i>

                        </div>

                        <div>

                            <h6 class="fw-bold mb-0">

                                Adhésion

                            </h6>

                            <small class="text-muted">

                                Statut et date d'adhésion

                            </small>

                        </div>

                    </div>


                    <div class="row g-3">


                        {{-- DATE ADHÉSION --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Date d'adhésion

                            </label>

                            <input type="date"
                                   name="date_adhesion"
                                   class="form-control"
                                   value="{{ old(
                                       'date_adhesion',
                                       $member->date_adhesion?->format('Y-m-d')
                                   ) }}">

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Statut

                            </label>

                            <select name="statut"
                                    class="form-select">

                                <option value="actif"
                                    {{ old(
                                        'statut',
                                        $member->statut
                                    ) === 'actif' ? 'selected' : '' }}>

                                    Actif

                                </option>

                                <option value="suspendu"
                                    {{ old(
                                        'statut',
                                        $member->statut
                                    ) === 'suspendu' ? 'selected' : '' }}>

                                    Suspendu

                                </option>

                                <option value="inactif"
                                    {{ old(
                                        'statut',
                                        $member->statut
                                    ) === 'inactif' ? 'selected' : '' }}>

                                    Inactif

                                </option>

                            </select>

                        </div>


                    </div>


                    {{-- ================================================= --}}
                    {{-- INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="alert alert-info mt-4 mb-0">

                        <i class="bi bi-info-circle-fill me-2"></i>

                        Le numéro de membre
                        <strong>{{ $member->numero_membre }}</strong>
                        ne peut pas être modifié.

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- FOOTER --}}
                {{-- ================================================= --}}

                <div class="modal-footer bg-light">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="bi bi-x-lg me-1"></i>

                        Annuler

                    </button>


                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-lg me-1"></i>

                        Enregistrer les modifications

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>
