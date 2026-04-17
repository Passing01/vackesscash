<!-- Header -->
<header class="header border-4 border-primary border-top position-fixed start-0 top-0 w-100">
    <div class="container">
        <div class="header-wrapper d-flex align-items-center justify-content-between py-2">
            <div class="logo">
                <a href="{{ url('/') }}" class="logo-white">
                    <img src="{{ asset('assets/images/vackess/vackesslogo.jpeg') }}" alt="logo" class="img-fluid" style="max-height: 45px; width: auto;">
                </a>
                <a href="{{ url('/') }}" class="logo-dark">
                    <img src="{{ asset('assets/images/vackess/vackesslogo.jpeg') }}" alt="logo" class="img-fluid" style="max-height: 45px; width: auto;">
                </a>
            </div>
            <div class="d-flex align-items-center gap-2 gap-sm-4">
                
                @if(request()->routeIs('demandedepot'))
                    <a href="{{ url('/') }}" class="btn btn-primary text-dark fw-bold px-3 px-sm-4 py-2 rounded-pill hstack gap-2 shadow-sm" style="font-size: 0.9rem;">
                        <iconify-icon icon="solar:home-angle-bold-duotone" class="fs-5"></iconify-icon>
                        <span class="d-none d-sm-inline">Accueil</span>
                        <span class="d-inline d-sm-none">Retour</span>
                    </a>
                @else
                    <a href="{{ route('demandedepot') }}" class="btn btn-primary text-dark fw-bold px-3 px-sm-4 py-2 rounded-pill hstack gap-2 shadow-sm" style="font-size: 0.9rem;">
                        <iconify-icon icon="solar:wallet-bold-duotone" class="fs-5"></iconify-icon>
                        <span class="d-none d-sm-inline">Demande de dépôt</span>
                        <span class="d-inline d-sm-none">Dépôt</span>
                    </a>
                @endif

            </div>
        </div>
    </div>
</header>