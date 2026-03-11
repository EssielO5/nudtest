@extends('master')
@section('guest')
<title>Nùdutin - Attirez de nouveaux clients</title>

    <main>
        

        <div class="hero_single version_3">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Attirez de nouveaux clients</h1>
                            <p>En tant que restaurants du coin</p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>
        <!-- /hero_single -->
        <div class="bg_gray">
            <div class="container margin_60_40">
                <div class="main_title center">
                    <span><em></em></span>
                    <h2>Pourquoi Nùdutin ?</h2>
                    {{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> --}}
                </div>

                <div class="row justify-content-center align-items-center add_bottom_15">
                    <div class="col-lg-5">
                        <div class="box_about">
                            <h3>Boostez votre visibilité</h3>
                            <p class="lead"></p>
                            <p> Nùdutin est un service en ligne qui aide les restaurants à augmenter le nombre de leurs clientè
                                le en
                                ligne. En utilisant notre plateforme, les restaurants peuvent créer un profil en ligne pour
                                leur entreprise, ajouter des photos, des menus et des informations sur leurs horaires
                                d'ouverture et leurs emplacements. Les clients peuvent ensuite effectuer des achats soit en ligne, 
                                soit en présentiel en découvrant les restaurants les plus proche d'eux.
                            </p>
                            <img src="{{ asset('assets-home/img/arrow_about.png') }}" alt="" class="arrow_1">
                        </div>
                    </div>
                    <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                        <img src="{{ asset('assets-home/img/about_1.svg') }}" alt="" class="img-fluid"
                            width="250" height="250">
                    </div>
                </div>
                <!-- /row -->
                <div class="row justify-content-center align-items-center add_bottom_15">
                    <div class="col-lg-5 pr-lg-5 text-center d-none d-lg-block">
                        <img src="{{ asset('assets-home/img/about_2.svg') }}" alt="" class="img-fluid"
                            width="250" height="250">
                    </div>
                    <div class="col-lg-5">
                        <div class="box_about">
                            <h3>Gérer facilement</h3>
                            <p>Les propriétaires d'entreprise peuvent gagner du temps et
                                de l'efficacité en ayant tous les outils de gestion essentiels à portée de main. Cela peut
                                leur permettre de se concentrer sur la croissance de leur entreprise et de fournir un
                                meilleur service à leurs clients.</p>
                            <img src="{{ asset('assets-home/img/arrow_about.png') }}" alt="" class="arrow_2">
                        </div>
                    </div>
                </div>
                <!-- /row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5">
                        <div class="box_about">
                            <h3>Atteindre de nouveaux clients</h3>
                            <p>Les entreprises peuvent étendre leur portée et augmenter leur nombre de clients
                                potentiels. Cela peut aider à stimuler la croissance de l'entreprise et à améliorer sa
                                rentabilité.</p>
                        </div>

                    </div>
                    <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                        <img src="{{ asset('assets-home/img/about_3.svg') }}" alt="" class="img-fluid"
                            width="250" height="250">
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->

    </main>
    <!-- /main -->
@endsection
