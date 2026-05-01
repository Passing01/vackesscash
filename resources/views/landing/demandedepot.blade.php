@extends('landing.layout.main')
@section('content')

    <section
        class="demande-depot-section py-5 py-lg-11 py-xl-12 bg-light-gray min-vh-100 d-flex align-items-center position-relative overflow-hidden">
        <!-- Background elements -->
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10 pointer-events-none">
            <img src="{{ asset('assets/images/backgrounds/stats-facts-bg.svg') }}"
                class="img-fluid w-100 h-100 object-fit-cover" alt="">
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="zoom-in"
                        data-aos-duration="800">
                        <div class="card-header bg-primary py-4 text-center border-0">
                            <div
                                class="round-64 bg-white rounded-circle hstack justify-content-center mx-auto mb-3 shadow-sm">
                                <iconify-icon icon="solar:card-2-bold-duotone" class="fs-9 text-primary"></iconify-icon>
                            </div>
                            <h3 class="mb-0 text-dark fw-bold">Demande de Dépôt</h3>
                            <p class="mb-0 text-dark text-opacity-75">Vackess Cash</p>
                        </div>

                        <!-- Step 1: Platform Selection -->
                        <div class="card-body p-4 p-lg-5" id="selection-container">
                            <h4 class="text-center mb-4 fw-bold">Sélectionnez votre plateforme</h4>
                            <div class="d-flex flex-column gap-3">
                                <!-- 1xBet -->
                                <div class="platform-card p-3 rounded-4 border-2 border d-flex align-items-center gap-3 cursor-pointer transition-all"
                                    onclick="selectPlatform('1xBet')">
                                    <div
                                        class="round-48 bg-primary bg-opacity-10 text-primary rounded-circle hstack justify-content-center flex-shrink-0">
                                        <img src="{{ asset('assets/images/vackess/1xbet.webp') }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 fw-bold">1xBet</h5>
                                        <p class="mb-0 small text-muted">Dépôt instantané & sécurisé</p>
                                    </div>
                                    <iconify-icon icon="solar:alt-arrow-right-bold-duotone"
                                        class="fs-6 text-muted"></iconify-icon>
                                </div>

                                <!-- Betwinner -->
                                <div class="platform-card p-3 rounded-4 border-2 border d-flex align-items-center gap-3 cursor-pointer transition-all"
                                    onclick="selectPlatform('Betwinner')">
                                    <div
                                        class="round-48 bg-success bg-opacity-10 text-success rounded-circle hstack justify-content-center flex-shrink-0">
                                        <img src="{{ asset('assets/images/vackess/betwinner.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 fw-bold">Betwinner</h5>
                                        <p class="mb-0 small text-muted">Rapide et sans frais</p>
                                    </div>
                                    <iconify-icon icon="solar:alt-arrow-right-bold-duotone"
                                        class="fs-6 text-muted"></iconify-icon>
                                </div>

                                <!-- Melbet -->
                                <div class="platform-card p-3 rounded-4 border-2 border d-flex align-items-center gap-3 cursor-pointer transition-all"
                                    onclick="selectPlatform('Melbet')">
                                    <div
                                        class="round-48 bg-warning bg-opacity-10 text-warning rounded-circle hstack justify-content-center flex-shrink-0">
                                        <img src="{{ asset('assets/images/vackess/melbet.webp') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 fw-bold">Melbet</h5>
                                        <p class="mb-0 small text-muted">Service disponible 24h/24</p>
                                    </div>
                                    <iconify-icon icon="solar:alt-arrow-right-bold-duotone"
                                        class="fs-6 text-muted"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Form (Hidden by default) -->
                        <div class="card-body p-4 p-lg-5 d-none" id="form-container">
                            <button class="btn btn-link text-decoration-none text-muted p-0 mb-4 hstack gap-2"
                                onclick="showSelection()">
                                <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
                                <span class="small fw-bold">Changer de plateforme</span>
                            </button>

                            <div class="text-center mb-4">
                                <h4 class="fw-bold" id="selected-platform-name">1xBet</h4>
                                <p class="text-muted small">Veuillez renseigner vos informations de dépôt.</p>
                            </div>

                            <form id="depotForm" class="d-flex flex-column gap-4">
                                @csrf
                                <input type="hidden" name="plateforme" id="plateforme_input" value="1xBet">

                                <div class="form-group">
                                    <label for="identifiant" class="form-label fw-bold text-dark">Identifiant Joueur</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><iconify-icon
                                                icon="solar:user-id-bold-duotone"></iconify-icon></span>
                                        <input type="text" class="form-control border-0 bg-light p-3" id="identifiant"
                                            name="identifiant" placeholder="Saisissez votre ID" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="montant" class="form-label fw-bold text-dark">Montant du dépôt (CFA)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><iconify-icon
                                                icon="solar:bill-list-bold-duotone"></iconify-icon></span>
                                        <input type="number" class="form-control border-0 bg-light p-3" id="montant"
                                            name="montant" placeholder="Ex: 5000" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-label fw-bold text-dark">Numéro de téléphone de paiement</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><iconify-icon
                                                icon="solar:phone-bold-duotone"></iconify-icon></span>
                                        <input type="tel" class="form-control border-0 bg-light p-3" id="phone"
                                            name="phone" placeholder="Ex: +22670123456" required>
                                    </div>
                                    <small class="text-muted">Format: +226XXXXXXXX</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-bold text-dark mb-3">Opérateur / Mode de paiement</label>
                                    <div class="row g-3" id="payment_methods_grid">
                                        <!-- Orange Money -->
                                        <div class="col-6">
                                            <div class="method-card p-3 rounded-4 border-2 border d-flex flex-column align-items-center text-center gap-2 cursor-pointer transition-all h-100"
                                                onclick="selectMethod('orange_money')">
                                                <img src="{{ asset('assets/images/vackess/Orange-Money-Burkina-Faso.webp') }}" class="img-fluid rounded-2" style="height: 40px; width: 40px; object-fit: contain;" alt="Orange">
                                                <span class="small fw-bold">Orange Money</span>
                                            </div>
                                        </div>
                                        <!-- Moov Money -->
                                        <div class="col-6">
                                            <div class="method-card p-3 rounded-4 border-2 border d-flex flex-column align-items-center text-center gap-2 cursor-pointer transition-all h-100"
                                                onclick="selectMethod('moov_money')">
                                                <img src="{{ asset('assets/images/vackess/moov-money.png') }}" class="img-fluid rounded-2" style="height: 40px; width: 40px; object-fit: contain;" alt="Moov">
                                                <span class="small fw-bold">Moov Money</span>
                                            </div>
                                        </div>
                                        <!-- Wave -->
                                        <div class="col-6">
                                            <div class="method-card p-3 rounded-4 border-2 border d-flex flex-column align-items-center text-center gap-2 cursor-pointer transition-all h-100"
                                                onclick="selectMethod('wave')">
                                                <img src="{{ asset('assets/images/vackess/Wave.png') }}" class="img-fluid rounded-2" style="height: 40px; width: 40px; object-fit: contain;" alt="Wave">
                                                <span class="small fw-bold">Wave</span>
                                            </div>
                                        </div>
                                        <!-- Telecel -->
                                        <div class="col-6">
                                            <div class="method-card p-3 rounded-4 border-2 border d-flex flex-column align-items-center text-center gap-2 cursor-pointer transition-all h-100"
                                                onclick="selectMethod('telecel')">
                                                <img src="{{ asset('assets/images/vackess/Telecel-money.png') }}" class="img-fluid rounded-2" style="height: 40px; width: 40px; object-fit: contain;" alt="Telecel">
                                                <span class="small fw-bold">Telecel Money</span>
                                            </div>
                                        </div>
                                        <!-- Card -->
                                        <div class="col-12">
                                            <div class="method-card p-3 rounded-4 border-2 border d-flex align-items-center justify-content-center gap-3 cursor-pointer transition-all"
                                                onclick="selectMethod('card')">
                                                <img src="{{ asset('assets/images/vackess/visa.webp') }}" class="img-fluid rounded-2" style="height: 30px; object-fit: contain;" alt="Visa/Mastercard">
                                                <span class="small fw-bold">Carte Bancaire (Visa / Mastercard)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="payment_method" id="payment_method_input" required>
                                </div>

                                <button type="submit"
                                    class="btn btn-dark w-100 py-3 rounded-pill d-flex align-items-center justify-content-center gap-2 mt-2"
                                    style="color: #ffffff !important; font-weight: 700 !important;">
                                    Envoyer ma demande
                                    <iconify-icon icon="solar:plain-2-bold-duotone" class="fs-5"
                                        style="color: #ffffff !important;"></iconify-icon>
                                </button>
                            </form>
                        </div>

                        <!-- Loader (Hidden by default) -->
                        <div class="card-body p-5 text-center d-none" id="loader-container">
                            <div class="d-flex flex-column align-items-center gap-4 py-5">
                                <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <h4 class="mb-0 fw-bold">Traitement en cours...</h4>
                                <p class="text-muted">Nous préparons votre demande, merci de patienter.</p>
                            </div>
                        </div>

                        <!-- Manual Payment Instructions & Proof (Hidden by default) -->
                        <div class="card-body p-4 p-lg-5 d-none" id="manual-container">
                            <button class="btn btn-link text-decoration-none text-muted p-0 mb-4 hstack gap-2"
                                onclick="showForm()">
                                <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
                                <span class="small fw-bold">Modifier les informations</span>
                            </button>

                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <img src="" id="manual-operator-logo" class="img-fluid rounded-4 shadow-sm p-2 bg-white" style="height: 100px; min-width: 100px; object-fit: contain; border: 1px solid #eee;">
                                </div>
                                <h4 class="fw-bold">Finalisez votre paiement</h4>
                                <p class="text-muted small">Suivez les instructions ci-dessous pour effectuer le paiement.</p>
                            </div>

                            <div class="bg-primary bg-opacity-10 p-4 rounded-4 mb-4 text-center border border-primary border-opacity-25">
                                <p class="mb-2 fw-bold text-primary">Code à composer sur votre téléphone :</p>
                                <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                    <h3 class="mb-0 fw-bolder text-primary text-break" id="manual-dial-code" style="letter-spacing: 1px;">*144*...#</h3>
                                    <button class="btn btn-sm btn-primary rounded-circle flex-shrink-0" onclick="copyDialCode()">
                                        <iconify-icon icon="solar:copy-bold-duotone"></iconify-icon>
                                    </button>
                                </div>
                                <p class="mt-2 mb-0 small text-dark">Montant exact : <span class="fw-bold" id="manual-amount-display">0</span> CFA</p>
                            </div>

                            <form id="manualForm" class="d-flex flex-column gap-3" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="plateforme" id="manual_plateforme">
                                <input type="hidden" name="identifiant" id="manual_identifiant">
                                <input type="hidden" name="montant" id="manual_montant">
                                <input type="hidden" name="phone" id="manual_phone">
                                <input type="hidden" name="payment_method" id="manual_method">

                                <div class="form-group">
                                    <label for="transaction_id" class="form-label fw-bold text-dark" id="transaction_id_label">ID de Transaction</label>
                                    <input type="text" class="form-control border-0 bg-light p-3" id="transaction_id"
                                        name="transaction_id" placeholder="Saisissez le code de référence" required>
                                    <small class="text-muted" id="transaction_id_help">Le code reçu par SMS après le paiement.</small>
                                </div>

                                <div class="form-group">
                                    <label for="proof_image" class="form-label fw-bold text-dark">Capture d'écran (Preuve)</label>
                                    <input type="file" class="form-control border-0 bg-light p-3" id="proof_image"
                                        name="proof_image" accept="image/*" required>
                                    <small class="text-muted">Capture d'écran de la confirmation de paiement.</small>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary w-100 py-3 rounded-pill d-flex align-items-center justify-content-center gap-2 mt-2"
                                    style="color: #ffffff !important; font-weight: 700 !important;">
                                    Confirmer mon paiement
                                    <iconify-icon icon="solar:check-read-bold-duotone" class="fs-5"></iconify-icon>
                                </button>
                            </form>
                        </div>

                        <!-- Success Message (Hidden by default) -->
                        <div class="card-body p-5 text-center d-none" id="success-container">
                            <div class="d-flex flex-column align-items-center gap-4 py-4">
                                <div
                                    class="round-80 bg-success bg-opacity-10 text-success rounded-circle hstack justify-content-center shadow-sm mx-auto">
                                    <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-13"></iconify-icon>
                                </div>
                                <div>
                                    <h3 class="fw-bold text-dark text-center">Demande envoyée !</h3>
                                    <p class="fs-5 text-muted mt-2 text-center">Votre demande de dépôt a été transmise avec
                                        succès.</p>
                                </div>
                                <div class="bg-light p-3 rounded-3 w-100">
                                    <p class="mb-0 text-dark small text-center"><iconify-icon
                                            icon="solar:clock-circle-bold-duotone" class="me-1"></iconify-icon> Elle sera
                                        traitée dans les prochaines minutes par notre équipe.</p>
                                </div>
                                <a href="{{ route('demandedepot') }}"
                                    class="btn btn-outline-dark rounded-pill px-4 mt-2 mx-auto">Faire une autre demande</a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                        <a href="/" class="text-dark opacity-75 text-decoration-none hstack gap-2 justify-content-center">
                            <iconify-icon icon="solar:arrow-left-bold-duotone"></iconify-icon>
                            Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .round-80 {
            width: 80px;
            height: 80px;
        }

        .round-64 {
            width: 64px;
            height: 64px;
        }

        .round-48 {
            width: 48px;
            height: 48px;
        }

        .fs-7 {
            font-size: 1.5rem;
        }

        .fs-13 {
            font-size: 4rem;
        }

        .input-group-text {
            border-radius: 0.75rem 0 0 0.75rem !important;
        }

        .form-control {
            border-radius: 0 0.75rem 0.75rem 0 !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .platform-card:hover {
            transform: translateY(-5px);
            border-color: var(--bs-primary) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .method-card {
            border-color: #eee !important;
            background: #fff;
        }

        .method-card:hover {
            border-color: var(--bs-primary) !important;
            background: rgba(var(--bs-primary-rgb), 0.02);
        }

        .method-card.selected {
            border-color: var(--bs-primary) !important;
            background: rgba(var(--bs-primary-rgb), 0.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .demande-depot-section {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }
        
        .text-break {
            word-break: break-word !important;
            overflow-wrap: break-word !important;
        }
    </style>

    <script>
        function selectPlatform(name) {
            document.getElementById('selected-platform-name').innerText = name;
            document.getElementById('plateforme_input').value = name;
            document.getElementById('selection-container').classList.add('d-none');
            document.getElementById('form-container').classList.remove('d-none');
            if (window.AOS) AOS.refresh();
        }

        function showSelection() {
            document.getElementById('form-container').classList.add('d-none');
            document.getElementById('manual-container').classList.add('d-none');
            document.getElementById('selection-container').classList.remove('d-none');
            if (window.AOS) AOS.refresh();
        }

        function showForm() {
            document.getElementById('manual-container').classList.add('d-none');
            document.getElementById('form-container').classList.remove('d-none');
            if (window.AOS) AOS.refresh();
        }

        function selectMethod(method) {
            // Update hidden input
            document.getElementById('payment_method_input').value = method;
            
            // Update UI
            document.querySelectorAll('.method-card').forEach(card => {
                card.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
        }

        function copyDialCode() {
            const code = document.getElementById('manual-dial-code').innerText;
            navigator.clipboard.writeText(code).then(() => {
                alert('Code copié !');
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('depotForm');
            const formContainer = document.getElementById('form-container');
            const selectionContainer = document.getElementById('selection-container');
            const loaderContainer = document.getElementById('loader-container');
            const successContainer = document.getElementById('success-container');

            // Check if we have a success status (passed from controller or via URL)
            const urlParams = new URLSearchParams(window.location.search);
            const isSuccess = urlParams.get('payment_status') === 'success' || "{{ $payment_status ?? '' }}" === 'success';

            if (isSuccess) {
                selectionContainer.classList.add('d-none');
                formContainer.classList.add('d-none');
                loaderContainer.classList.add('d-none');
                successContainer.classList.remove('d-none');
                if (window.AOS) AOS.refresh();
            }

            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(form);

                    // Show loader
                    formContainer.classList.add('d-none');
                    loaderContainer.classList.remove('d-none');

                    fetch("{{ route('payment.initiate') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (data.manual) {
                                    // Handle Manual Flow
                                    loaderContainer.classList.add('d-none');
                                    document.getElementById('manual-container').classList.remove('d-none');
                                    
                                    // Fill hidden fields
                                    document.getElementById('manual_plateforme').value = formData.get('plateforme');
                                    document.getElementById('manual_identifiant').value = formData.get('identifiant');
                                    document.getElementById('manual_montant').value = formData.get('montant');
                                    document.getElementById('manual_phone').value = formData.get('phone');
                                    document.getElementById('manual_method').value = data.method;
                                    
                                    document.getElementById('manual-amount-display').innerText = formData.get('montant');
                                    
                                    // Set Dial Code based on method
                                    let code = "*144*...#";
                                    let label = "ID de Transaction";
                                    let placeholder = "Saisissez le code de référence";
                                    let logo = "";
                                    const amount = formData.get('montant');
                                    
                                    if (data.method === 'orange_money') {
                                        code = `*144*2*1*44333323*${amount}#`;
                                        label = "ID Transaction Orange Money";
                                        placeholder = "Ex: OM123456789";
                                        logo = "{{ asset('assets/images/vackess/Orange-Money-Burkina-Faso.webp') }}";
                                    } else if (data.method === 'moov_money') {
                                        code = `*555*2*1*60486678*${amount}#`;
                                        label = "ID Transaction Moov Money";
                                        placeholder = "Ex: MOOV123456";
                                        logo = "{{ asset('assets/images/vackess/moov-money.png') }}";
                                    } else if (data.method === 'telecel') {
                                        code = `*808*2*1*78397293*${amount}#`;
                                        label = "ID Transaction Telecel Cash";
                                        placeholder = "Ex: TEL123456";
                                        logo = "{{ asset('assets/images/vackess/Telecel-money.png') }}";
                                    }
                                    
                                    document.getElementById('manual-dial-code').innerText = code;
                                    document.getElementById('transaction_id_label').innerText = label;
                                    document.getElementById('transaction_id').placeholder = placeholder;
                                    document.getElementById('manual-operator-logo').src = logo;
                                    
                                    if (window.AOS) AOS.refresh();
                                } else if (data.redirect_url) {
                                    window.location.href = data.redirect_url;
                                } else {
                                    loaderContainer.classList.add('d-none');
                                    successContainer.classList.remove('d-none');
                                    if (window.AOS) AOS.refresh();
                                }
                            } else {
                                alert(data.message || 'Une erreur est survenue lors de l\'initiation du paiement.');
                                formContainer.classList.remove('d-none');
                                loaderContainer.classList.add('d-none');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Une erreur technique est survenue.');
                            formContainer.classList.remove('d-none');
                            loaderContainer.classList.add('d-none');
                        });
                });
            }

            const manualForm = document.getElementById('manualForm');
            if (manualForm) {
                manualForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    
                    const formData = new FormData(manualForm);
                    
                    document.getElementById('manual-container').classList.add('d-none');
                    loaderContainer.classList.remove('d-none');
                    
                    fetch("{{ route('payment.manual') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        loaderContainer.classList.add('d-none');
                        if (data.success) {
                            successContainer.classList.remove('d-none');
                            if (window.AOS) AOS.refresh();
                        } else {
                            alert(data.message || 'Une erreur est survenue.');
                            document.getElementById('manual-container').classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Une erreur technique est survenue.');
                        loaderContainer.classList.add('d-none');
                        document.getElementById('manual-container').classList.remove('d-none');
                    });
                });
            }
        });
    </script>

@endsection