<div class="modal fade"
     id="modalAjouterMembre"
     tabindex="-1"
     aria-labelledby="modalAjouterMembreLabel"
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
                        id="modalAjouterMembreLabel">

                        <i class="bi bi-person-plus-fill me-2"></i>
                        Nouveau membre

                    </h5>

                    <small class="opacity-75">
                        Enregistrement d'un nouveau membre UNEAC
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

                        Impossible d'enregistrer le membre

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

            <form action="{{ route('members.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- BODY SCROLLABLE --}}
                <div class="modal-body"
                     style="max-height: 65vh; overflow-y: auto;">


                    {{-- ================================================= --}}
                    {{-- IDENTITÉ --}}
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


                    <div class="row g-3">

                        {{-- NOM --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Nom
                                <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="nom"
                                   class="form-control @error('nom') is-invalid @enderror"
                                   value="{{ old('nom') }}"
                                   placeholder="Nom"
                                   required>

                            @error('nom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- POSTNOM --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Postnom
                            </label>

                            <input type="text"
                                   name="postnom"
                                   class="form-control"
                                   value="{{ old('postnom') }}"
                                   placeholder="Postnom">

                        </div>


                        {{-- PRÉNOM --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Prénom
                                <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="prenom"
                                   class="form-control @error('prenom') is-invalid @enderror"
                                   value="{{ old('prenom') }}"
                                   placeholder="Prénom"
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
                                   value="{{ old('date_naissance') }}">

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
                                    {{ old('sexe') == 'M' ? 'selected' : '' }}>
                                    Masculin
                                </option>

                                <option value="F"
                                    {{ old('sexe') == 'F' ? 'selected' : '' }}>
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
                                   value="{{ old('lieu_naissance') }}"
                                   placeholder="Ex : Brazzaville">

                        </div>


                        {{-- NATIONALITÉ --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Nationalité
                            </label>

                            <input type="text"
                                   name="nationalite"
                                   class="form-control"
                                   value="{{ old('nationalite', 'Congolaise') }}">

                        </div>


                        {{-- TÉLÉPHONE --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Téléphone
                            </label>

                            <input type="text"
                                   name="telephone"
                                   class="form-control"
                                   value="{{ old('telephone') }}"
                                   placeholder="+242 ...">

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="exemple@email.com">

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
                                      rows="2"
                                      placeholder="Adresse / quartier / arrondissement">{{ old('domicile') }}</textarea>

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
                                   value="{{ old('profession_artistique') }}"
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
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>

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
                                        {{ old('federation_id') == $federation->id ? 'selected' : '' }}>

                                        {{ $federation->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- ================================================= --}}
                    {{-- CARTE / ADHÉSION --}}
                    {{-- ================================================= --}}

                    <div class="d-flex align-items-center mb-3">

                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">

                            <i class="bi bi-card-checklist text-primary fs-5"></i>

                        </div>

                        <div>

                            <h6 class="fw-bold mb-0">
                                Adhésion et identification
                            </h6>

                            <small class="text-muted">
                                Informations utilisées pour la carte UNEAC
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
                                   value="{{ old('date_adhesion', date('Y-m-d')) }}">

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Statut
                            </label>

                            <select name="statut"
                                    class="form-select">

                                <option value="actif"
                                    {{ old('statut', 'actif') == 'actif' ? 'selected' : '' }}>
                                    Actif
                                </option>

                                <option value="suspendu"
                                    {{ old('statut') == 'suspendu' ? 'selected' : '' }}>
                                    Suspendu
                                </option>

                                <option value="inactif"
                                    {{ old('statut') == 'inactif' ? 'selected' : '' }}>
                                    Inactif
                                </option>

                            </select>

                        </div>


                        {{-- PHOTO --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Photo du membre

                                <span class="text-danger">*</span>

                            </label>

                            <input type="file"
                                   name="photo"
                                   id="photoMembre"
                                   class="form-control @error('photo') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/jpg"
                                   required>

                            @error('photo')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <small class="text-muted">
                                JPG, JPEG ou PNG — maximum 5 Mo
                            </small>

                        </div>

                    </div>


                    {{-- INFORMATION NUMÉRO --}}
                    <div class="alert alert-primary mt-4 mb-0">

                        <div class="d-flex">

                            <i class="bi bi-info-circle-fill fs-5 me-2"></i>

                            <div>

                                <strong>Numéro de membre automatique</strong>

                                <div class="small mt-1">

                                    Le système générera automatiquement le numéro
                                    du membre après l'enregistrement.

                                    Exemple :
                                    <strong>UNEAC-00001</strong>

                                </div>

                            </div>

                        </div>

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

                        Enregistrer le membre

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
