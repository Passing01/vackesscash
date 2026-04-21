@extends('landing.layout.main')
@section('content')

<section class="demande-depot-section py-5 py-lg-11 py-xl-12 bg-light-gray min-vh-100 d-flex align-items-center position-relative overflow-hidden">
    <!-- Background elements -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10 pointer-events-none">
        <img src="{{ asset('assets/images/backgrounds/stats-facts-bg.svg') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="zoom-in" data-aos-duration="800">
                    <div class="card-header bg-primary py-4 text-center border-0">
                        <div class="round-64 bg-white rounded-circle hstack justify-content-center mx-auto mb-3 shadow-sm">
                            <iconify-icon icon="solar:card-2-bold-duotone" class="fs-9 text-primary"></iconify-icon>
                        </div>
                        <h3 class="mb-0 text-dark fw-bold">Demande de Dépôt</h3>
                        <p class="mb-0 text-dark text-opacity-75">Vackess Cash - 1xBet</p>
                    </div>
                    
                    <!-- Step 1: Platform Selection -->
                    <div class="card-body p-4 p-lg-5" id="selection-container">
                        <h4 class="text-center mb-4 fw-bold">Sélectionnez votre plateforme</h4>
                        <div class="d-flex flex-column gap-3">
                            <!-- 1xBet -->
                            <div class="platform-card p-3 rounded-4 border-2 border d-flex align-items-center gap-3 cursor-pointer transition-all" onclick="selectPlatform('1xBet')">
                                <div class="round-48 bg-primary bg-opacity-10 text-primary rounded-circle hstack justify-content-center flex-shrink-0">
                                    <iconify-icon icon="simple-icons:1xbet" class="fs-7"></iconify-icon>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fw-bold">1xBet</h5>
                                    <p class="mb-0 small text-muted">Dépôt instantané & sécurisé</p>
                                </div>
                                <iconify-icon icon="solar:alt-arrow-right-bold-duotone" class="fs-6 text-muted"></iconify-icon>
                            </div>

                            <!-- Betwinner -->
                            <div class="platform-card p-3 rounded-4 border-2 border d-flex align-items-center gap-3 cursor-pointer transition-all" onclick="selectPlatform('Betwinner')">
                                <div class="round-48 bg-success bg-opacity-10 text-success rounded-circle hstack justify-content-center flex-shrink-0">
                                    <iconify-icon icon="simple-icons:betwinner" class="fs-7"></iconify-icon>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fw-bold">Betwinner</h5>
                                    <p class="mb-0 small text-muted">Rapide et sans frais</p>
                                </div>
                                <iconify-icon icon="solar:alt-arrow-right-bold-duotone" class="fs-6 text-muted"></iconify-icon>
                            </div>

                            <!-- Melbet -->
                            <div class="platform-card p-3 rounded-4 border-2 border d-flex align-items-center gap-3 cursor-pointer transition-all" onclick="selectPlatform('Melbet')">
                                <div class="round-48 bg-warning bg-opacity-10 text-warning rounded-circle hstack justify-content-center flex-shrink-0">
                                    <iconify-icon icon="simple-icons:melbet" class="fs-7"></iconify-icon>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fw-bold">Melbet</h5>
                                    <p class="mb-0 small text-muted">Service disponible 24h/24</p>
                                </div>
                                <iconify-icon icon="solar:alt-arrow-right-bold-duotone" class="fs-6 text-muted"></iconify-icon>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Form (Hidden by default) -->
                    <div class="card-body p-4 p-lg-5 d-none" id="form-container">
                        <button class="btn btn-link text-decoration-none text-muted p-0 mb-4 hstack gap-2" onclick="showSelection()">
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
                                    <span class="input-group-text bg-light border-0"><iconify-icon icon="solar:user-id-bold-duotone"></iconify-icon></span>
                                    <input type="text" class="form-control border-0 bg-light p-3" id="identifiant" name="identifiant" placeholder="Saisissez votre ID" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="montant" class="form-label fw-bold text-dark">Montant du dépôt (CFA)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon></span>
                                    <input type="number" class="form-control border-0 bg-light p-3" id="montant" name="montant" placeholder="Ex: 5000" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-3 rounded-pill d-flex align-items-center justify-content-center gap-2 mt-2" style="color: #ffffff !important; font-weight: 700 !important;">
                                Envoyer ma demande
                                <iconify-icon icon="solar:plain-2-bold-duotone" class="fs-5" style="color: #ffffff !important;"></iconify-icon>
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

                    <!-- Success Message (Hidden by default) -->
                    <div class="card-body p-5 text-center d-none" id="success-container">
                        <div class="d-flex flex-column align-items-center gap-4 py-4">
                            <div class="round-80 bg-success bg-opacity-10 text-success rounded-circle hstack justify-content-center shadow-sm mx-auto">
                                <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-13"></iconify-icon>
                            </div>
                            <div>
                                <h3 class="fw-bold text-dark text-center">Demande envoyée !</h3>
                                <p class="fs-5 text-muted mt-2 text-center">Votre demande de dépôt a été transmise avec succès.</p>
                            </div>
                            <div class="bg-light p-3 rounded-3 w-100">
                                <p class="mb-0 text-dark small text-center"><iconify-icon icon="solar:clock-circle-bold-duotone" class="me-1"></iconify-icon> Elle sera traitée dans les prochaines minutes par notre équipe.</p>
                            </div>
                            <a href="{{ route('demandedepot') }}" class="btn btn-outline-dark rounded-pill px-4 mt-2 mx-auto">Faire une autre demande</a>
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
    .round-80 { width: 80px; height: 80px; }
    .round-64 { width: 64px; height: 64px; }
    .round-48 { width: 48px; height: 48px; }
    .fs-7 { font-size: 1.5rem; }
    .fs-13 { font-size: 4rem; }
    .input-group-text { border-radius: 0.75rem 0 0 0.75rem !important; }
    .form-control { border-radius: 0 0.75rem 0.75rem 0 !important; }
    .bg-light { background-color: #f8f9fa !important; }
    .cursor-pointer { cursor: pointer; }
    .transition-all { transition: all 0.3s ease; }
    
    .platform-card:hover {
        transform: translateY(-5px);
        border-color: var(--bs-primary) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .demande-depot-section {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
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
    document.getElementById('selection-container').classList.remove('d-none');
    if (window.AOS) AOS.refresh();
}

document.addEventListener('DOMContentLoaded', function() {
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
        form.addEventListener('submit', function(e) {
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
                if (data.success && data.redirect_url) {
                    // Redirect to PayDunya checkout
                    window.location.href = data.redirect_url;
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
});
</script>

@endsection