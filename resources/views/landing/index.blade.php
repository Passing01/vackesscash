@extends('landing.layout.main')
@section('content')


    <!--  Page Wrapper -->
    <div class="page-wrapper overflow-hidden">

        <!--  Banner Section -->
        <section class="banner-section position-relative d-flex align-items-end min-vh-100">
            <video class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" autoplay muted loop playsinline>
                <source src="{{ asset('assets/images/vackess/vackessvideo.mp4') }}" type="video/mp4" />
            </video>
            <div class="container">
                <div class="d-flex flex-column gap-4 pb-8 position-relative z-1">
                    <!-- <div class="row align-items-center">
                                                                <div class="col-xl-4">
                                                                    <div class="d-flex align-items-center gap-4" data-aos="fade-up" data-aos-delay="100"
                                                                        data-aos-duration="1000">
                                                                        <img src="../assets/images/svgs/primary-leaf.svg" alt="" class="img-fluid animate-spin">
                                                                        <p class="mb-0 text-white fs-5 text-opacity-70">We create <span
                                                                                class="text-primary">high-performing</span> digital designs that elevate brands and
                                                                            enhance
                                                                            conversions.</p>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                    <div class="d-flex align-items-end gap-3" data-aos="fade-up" data-aos-delay="200"
                        data-aos-duration="1000">
                        <h1 class="mb-0 fs-16 text-white lh-1">Vackess Cash</h1>
                        <!-- <a href="javascript:void(0)" class="p-1 ps-7 bg-primary rounded-pill">
                                                                        <span class="bg-white round-52 rounded-circle d-flex align-items-center justify-content-center">
                                                                            <iconify-icon icon="lucide:arrow-up-right" class="fs-8 text-dark"></iconify-icon>
                                                                        </span>
                                                                    </a> -->
                    </div>
                </div>
            </div>
        </section>

        <!--  Stats & Facts Section -->
        <section class="stats-facts py-5 py-lg-11 py-xl-12 position-relative overflow-hidden">
            <div class="container">
                <div class="row align-items-center gap-7 gap-lg-0">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-6" data-aos="fade-right" data-aos-delay="100"
                            data-aos-duration="1000">
                            <div class="d-flex align-items-center gap-7 py-2">
                                <span
                                    class="round-36 flex-shrink-0 text-dark rounded-circle bg-primary hstack justify-content-center fw-medium">01</span>
                                <hr class="border-line">
                                <span class="badge text-bg-dark">Ouverture de compte</span>
                            </div>
                            <h2 class="mb-0">Comment s'inscrire avec le code promo ?</h2>
                            <p class="fs-5 mb-0">Suivez ces étapes simples pour créer votre compte et maximiser vos bonus
                                dès le départ.</p>

                            <ul class="list-unstyled d-flex flex-column gap-4 mt-2">
                                <li class="d-flex gap-3 align-items-start">
                                    <div class="round-24 bg-primary text-dark rounded-circle hstack justify-content-center flex-shrink-0 mt-1"
                                        style="width: 24px; height: 24px; font-size: 14px; font-weight: bold;">1</div>
                                    <div>
                                        <h5 class="mb-1">Site Officiel</h5>
                                        <p class="mb-0">Rendez-vous sur la plateforme officielle 1xBet.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-3 align-items-start">
                                    <div class="round-24 bg-primary text-dark rounded-circle hstack justify-content-center flex-shrink-0 mt-1"
                                        style="width: 24px; height: 24px; font-size: 14px; font-weight: bold;">2</div>
                                    <div>
                                        <h5 class="mb-1">Détails Personnels</h5>
                                        <p class="mb-0">Cliquez sur « Inscription » et remplissez vos informations.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-3 align-items-start">
                                    <div class="round-24 bg-primary text-dark rounded-circle hstack justify-content-center flex-shrink-0 mt-1"
                                        style="width: 24px; height: 24px; font-size: 14px; font-weight: bold;">3</div>
                                    <div>
                                        <h5 class="mb-1">Code Promo : <span class="text-primary fw-bold">VR226</span></h5>
                                        <p class="mb-0">Saisissez le code <span
                                                class="badge bg-primary text-dark">VR226</span> pour activer vos bonus
                                            exclusifs.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-3 align-items-start">
                                    <div class="round-24 bg-primary text-dark rounded-circle hstack justify-content-center flex-shrink-0 mt-1"
                                        style="width: 24px; height: 24px; font-size: 14px; font-weight: bold;">4</div>
                                    <div>
                                        <h5 class="mb-1">Validation</h5>
                                        <p class="mb-0">Confirmez votre inscription et profitez de l'offre !</p>
                                    </div>
                                </li>
                            </ul>

                            <a href="{{ route('demandedepot') }}" class="btn mt-4" data-aos="fade-up" data-aos-delay="500"
                                data-aos-duration="1000">
                                <span class="btn-text">Demande de depot</span>
                                <iconify-icon icon="lucide:arrow-up-right"
                                    class="btn-icon bg-white text-dark round-52 rounded-circle hstack justify-content-center fs-7 shadow-sm"></iconify-icon>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="video-container position-relative rounded-4 overflow-hidden border border-primary border-4 shadow-lg" style="position: relative; z-index: 10;">
                            <video class="w-100 shadow-sm" controls playsinline webkit-playsinline preload="metadata"
                                poster="{{ asset('assets/images/vackess/vackess1.jpeg') }}">
                                <source src="{{ asset('assets/images/vackess/vackess5.mp4') }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-absolute bottom-0 start-0 pointer-events-none" data-aos="zoom-in" data-aos-delay="100"
                data-aos-duration="1000">
                <img src="../assets/images/backgrounds/stats-facts-bg.svg" alt="" class="img-fluid text-opacity-20">
            </div>
        </section>

        <!-- Nos Services Section -->
        <section class="nos-services py-5 py-lg-11 py-xl-12 bg-dark position-relative overflow-hidden">
            <div class="container">
                <div id="servicesCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <!-- Slide 1 : Dépôts et Retraits (vackess4) -->
                        <div class="carousel-item active" data-bs-interval="5000">
                            <div class="row align-items-center gap-7 gap-lg-0">
                                <!-- Texte à gauche -->
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column gap-6">
                                        <div class="d-flex align-items-center gap-7 py-2">
                                            <span
                                                class="round-36 flex-shrink-0 text-dark rounded-circle bg-primary hstack justify-content-center fw-medium">02</span>
                                            <hr class="border-line bg-white">
                                            <span class="badge text-bg-primary">Nos Services</span>
                                        </div>

                                        <h2 class="mb-0 text-white">Dépôts & Retraits<br>sur vos plateformes favorites</h2>
                                        <p class="fs-5 text-white text-opacity-70">Optez pour le meilleur en choisissant
                                            <span class="text-primary fw-bold">Vackess Cash</span> pour toutes vos
                                            transactions sur <strong class="text-white">1XBET</strong>, <strong
                                                class="text-white">BETWINNER</strong> et <strong
                                                class="text-white">MELBET</strong>. Un service rapide, fiable et disponible
                                            24h/24.
                                        </p>

                                        <!-- Plateformes -->
                                        <div class="d-flex flex-column gap-3">
                                            <div class="d-flex align-items-center gap-3 p-3 rounded-3"
                                                style="background: rgba(255,255,255,0.05);">
                                                <iconify-icon icon="solar:check-circle-bold-duotone"
                                                    class="fs-7 text-primary flex-shrink-0"></iconify-icon>
                                                <div>
                                                    <h5 class="mb-0 text-white">1XBET</h5>
                                                    <p class="mb-0 small text-white text-opacity-50">Dépôts & Retraits
                                                        instantanés</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 p-3 rounded-3"
                                                style="background: rgba(255,255,255,0.05);">
                                                <iconify-icon icon="solar:check-circle-bold-duotone"
                                                    class="fs-7 text-primary flex-shrink-0"></iconify-icon>
                                                <div>
                                                    <h5 class="mb-0 text-white">MELBET</h5>
                                                    <p class="mb-0 small text-white text-opacity-50">Transactions rapides et
                                                        sécurisées</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 p-3 rounded-3"
                                                style="background: rgba(255,255,255,0.05);">
                                                <iconify-icon icon="solar:check-circle-bold-duotone"
                                                    class="fs-7 text-primary flex-shrink-0"></iconify-icon>
                                                <div>
                                                    <h5 class="mb-0 text-white">BETWINNER</h5>
                                                    <p class="mb-0 small text-white text-opacity-50">Disponible à toute
                                                        heure</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Badge code promo + Contact -->
                                        <div class="d-flex flex-wrap gap-4 mt-2">
                                            <div class="p-3 rounded-3 text-center"
                                                style="background: #f97316; min-width: 160px;">
                                                <p class="mb-1 small fw-bold text-white">► Code promo</p>
                                                <h3 class="mb-0 fw-bold text-white letter-spacing-2">VR226</h3>
                                                <p class="mb-0 small text-white text-opacity-75">200% de bonus à
                                                    l'inscription</p>
                                            </div>
                                            <div class="p-3 rounded-3 d-flex flex-column justify-content-center gap-2"
                                                style="background: rgba(255,255,255,0.07);">
                                                <a href="https://wa.me/22678397293"
                                                    class="text-white text-decoration-none hstack gap-2">
                                                    <iconify-icon icon="solar:phone-bold-duotone"
                                                        class="fs-6 text-primary"></iconify-icon>
                                                    <span class="fw-bold">+226 78 39 72 93</span>
                                                </a>
                                                <div class="hstack gap-2 text-white text-opacity-70">
                                                    <iconify-icon icon="solar:map-point-bold-duotone"
                                                        class="fs-6 text-primary"></iconify-icon>
                                                    <span class="small">Boromo, sur la route de Siby</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image à droite -->
                                <div class="col-lg-6">
                                    <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                                        <img src="{{ asset('assets/images/vackess/vackess4.jpeg') }}"
                                            alt="Vackess Cash - Dépôts et Retraits" class="img-fluid w-100 rounded-4">
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-primary text-dark fw-bold px-3 py-2 fs-6 shadow">Gagnez
                                                200% 🎁</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 : Codes Promo (vackess3) -->
                        <div class="carousel-item" data-bs-interval="5000">
                            <div class="row align-items-center gap-7 gap-lg-0">
                                <!-- Texte à gauche -->
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column gap-6">
                                        <div class="d-flex align-items-center gap-7 py-2">
                                            <span
                                                class="round-36 flex-shrink-0 text-dark rounded-circle bg-primary hstack justify-content-center fw-medium">02</span>
                                            <hr class="border-line bg-white">
                                            <span class="badge text-bg-primary">Nos Codes Promo</span>
                                        </div>

                                        <h2 class="mb-0 text-white">Paris Sportifs &<br>Transactions Mobiles</h2>
                                        <p class="fs-5 text-white text-opacity-70">Profitez de nos offres exclusives lors de
                                            la création de vos comptes. Utilisez nos codes promo pour maximiser vos
                                            avantages sur toutes vos plateformes.</p>

                                        <!-- Grille Codes Promo -->
                                        <div class="row g-4 mt-2">
                                            <div class="col-sm-6">
                                                <div
                                                    class="bg-white rounded-3 p-4 text-center shadow-lg position-relative border-bottom border-4 border-primary">
                                                    <h5 class="text-dark mb-3 fw-bold">1XBET</h5>
                                                    <span
                                                        class="badge bg-dark fs-5 py-2 px-4 w-100 rounded-pill">VR226</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div
                                                    class="bg-white rounded-3 p-4 text-center shadow-lg position-relative border-bottom border-4 border-success">
                                                    <h5 class="text-dark mb-3 fw-bold">BETWINNER</h5>
                                                    <span
                                                        class="badge bg-dark fs-5 py-2 px-4 w-100 rounded-pill">VR94</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div
                                                    class="bg-white rounded-3 p-4 text-center shadow-lg position-relative border-bottom border-4 border-warning">
                                                    <h5 class="text-dark mb-3 fw-bold">MELBET</h5>
                                                    <span class="badge bg-dark fs-5 py-2 px-4 rounded-pill d-inline-block"
                                                        style="min-width: 150px;">VR1212</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Assistance WhatsApp -->
                                        <div class="d-flex align-items-center gap-4 p-4 rounded-3 mt-4"
                                            style="background: rgba(255,255,255,0.05); border-left: 4px solid #25D366;">
                                            <iconify-icon icon="logos:whatsapp-icon" class="fs-10"></iconify-icon>
                                            <div>
                                                <h5 class="text-white mb-1">Besoin d'aide ?</h5>
                                                <a href="https://wa.me/22678397293"
                                                    class="text-white text-decoration-none fw-bold fs-4 stretched-link">+226
                                                    78 39 72 93</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image à droite -->
                                <div class="col-lg-6">
                                    <div class="position-relative rounded-4 overflow-hidden shadow-lg p-2 bg-white">
                                        <img src="{{ asset('assets/images/vackess/vackess3.jpeg') }}"
                                            alt="Vackess Cash - Codes Promo transaction mobile"
                                            class="img-fluid w-100 rounded-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Contrôles du Carrousel -->
                    <div class="d-flex justify-content-center gap-3 mt-9 mt-lg-11">
                        <button class="btn btn-outline-light rounded-circle round-48 hstack justify-content-center"
                            type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
                            <iconify-icon icon="solar:alt-arrow-left-linear" class="fs-6"></iconify-icon>
                        </button>
                        <button class="btn btn-outline-light rounded-circle round-48 hstack justify-content-center"
                            type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="fs-6"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </section>



    </div>


@endsection