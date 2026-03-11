@extends('master')
@section('guest')
<title>Nùdutin - Découvrez les restaurants</title>
<!-- /header -->
	<main>
		<div class="hero_single version_2">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>Commandez &amp; Découvrez</h1>
							<p>le meilleur restaurant <span class="element" style="font-weight: 500"></span></p>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
		</div>


		<div class="container margin_60_40">
			<div class="main_title">
				<span><em></em></span>
				<h2>Restaurants populaires</h2>
				{{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> --}}
				<a href="{{ route('view_all') }}">Tout voir</a>
			</div>

			<div class="owl-carousel owl-theme carousel_4">
            @foreach ($restaurants as $restaurant)
			    <div class="item">
			        <div class="strip">
			            <figure>
                            @if( $restaurant->phone != '')
			                    <span class="ribbon off">{{  $restaurant->phone  }} </span>
                            @endif
                            <img src="{{ asset('images/restaurants/'. $restaurant->image) }}" data-src="{{ asset('images/restaurants/'. $restaurant->image) }}" class="img-fluid lazy" alt="Image du restaurant">

			                <a href="{{ route('client.plats_of_this_restaurant', $restaurant->id) }}" class="strip_info">
			                    <small>{{ $restaurant->name }}</small>
			                    <div class="item_title">
			                        <h3>{{ $restaurant->name }}</h3>
			                        <small>{{ $restaurant->location }}</small>
			                        {{-- <small>{{ $restaurant->description }}</small> --}}
			                    </div>
			                </a>

			            </figure>
			            <ul>
			                <li>
			                    {{-- <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div> --}}
			                </li>
			            </ul>
			        </div>
			    </div>
                @endforeach
			</div>
			<!-- /carousel -->

			<div class="banner lazy" data-bg="url(assets-home/img/blog-1.jpg)">
				<div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.2)">
					<div>
						<small>Nùdutin</small>
						<h3>Plus de 100 restaurants</h3>
						<p>Commander un plat facilement au meilleur prix</p>
						{{-- <a href="grid-listing-filterscol.html" class="btn_1">Tout voir</a> --}}
					</div>
				</div>
				<!-- /wrapper -->
			</div>
			<!-- /banner -->

            <div class="main_title">
				<span><em></em></span>
				<h2>Plats les plus aimés</h2>
				{{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> --}}
				{{--  <a href="{{ route('view_all') }}">Tout voir</a> --}}
			</div>

			<div class="owl-carousel owl-theme carousel_4">
            @foreach ($plats as $plat)
			    <div class="item">
			        <div class="strip">
			            <figure>
                            @if( $plat->price != '')
			                    <span class="ribbon off">{{  $plat->price  }} fcfa</span>
                            @endif
                            <img src="{{ asset('images/plats/'. $plat->image) }}" data-src="{{ asset('images/plats/'. $plat->image) }}" class="img-fluid lazy" alt="Image du plat">

			                <a href="{{ route('client.show_plat', $plat->id) }}" class="strip_info">
			                    <small>{{ $plat->category->name }}</small>
			                    <div class="item_title">
			                        <h3>{{ $plat->name }}</h3>
			                        <small>
                                        @if( $plat->description != '')
                                            {{  $plat->description  }}
                                        @endif
                                    </small>
			                        {{-- <small>{{ $restaurant->description }}</small> --}}
			                    </div>
			                </a>

			            </figure>
			            <ul>
			                <li>
			                    {{-- <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div> --}}
			                </li>
			            </ul>
			        </div>
			    </div>
                @endforeach
			</div>
			<!-- /carousel -->

		<div class="call_section lazy" data-bg="url(img/reservation-bg.jpg)">
		    <div class="container clearfix">
		        <div class="col-lg-5 col-md-6 float-end wow">
		            <div class="box_1">
		                <h3>Êtes-vous un propriétaire de restaurant?</h3>
		                <p>Rejoignez-nous pour augmenter votre visibilité en ligne. Vous aurez accès à encore plus de clients qui souhaitent profiter de vos plats savoureux à la maison.</p>
		                <a href="{{ route ('restaurant.register') }}" class="btn_1">En savoir plus</a>
		            </div>
		        </div>
    		</div>
    	</div>
   		<!--/call_section-->

	</main>
	<!-- /main -->
@endsection
