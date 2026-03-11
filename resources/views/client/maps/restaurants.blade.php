@extends('master')
@section('guest')
<title>Nùdutin - Découvrez les restaurants</title>
<!-- /header -->
	<main>
		<div class="hero_single version_2">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-8 mt-2">
							<h1 class="mb-4">Recherchez un restaurant à proximité</h1>
                            <form action="{{ route('client.maps') }}" class="myForm" method="post" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="latitude" id="latitude" placeholder="latitude" value="">
                                    <input type="hidden" name="longitude" id="longitude" placeholder="longitude" value="">
                                    @error('latitude')
                                        <p class=" fs-4 badge bg-danger text-white">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    @if(!isset($restaurants))
                                        <input type="submit" class="btn btn-success p-2 text-bold fs-4" value="Lancer la recherche">
                                    @endif
                                </div>
                            </form>
						</div>

					</div>
					<!-- /row -->
				</div>
			</div>
		</div>


        @isset($restaurants)
            <div class="container margin_60_40">
                <div class="main_title">
                    <span><em></em></span>
                    <h2>Restaurants proches de moi</h2>
                    {{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> --}}
                </div>


                    <div class="owl-carousel owl-theme carousel_4">
                        @foreach ($restaurants as $restaurant)
                            @if ($restaurant->distance != null && $restaurant->distance < 30000) {{-- Distance < 30 km --}}
                                <div class="item">
                                    <div class="strip">
                                        <figure>
                                            @if( $restaurant->phone != '')
                                                <span class="ribbon off">{{  $restaurant->phone  }} </span>
                                            @endif
                                            <img src="{{ asset('images/restaurants/'. $restaurant->image) }}" data-src="{{ asset('images/restaurants/'. $restaurant->image) }}" class="img-fluid lazy" alt="Image du restaurant">

                                            <a href="{{ route('client.plats_of_this_restaurant', $restaurant->id) }}" class="strip_info">
                                                <small>{{ number_format($restaurant->distance / 1000, 2, thousands_separator: '') }} km</small>
                                                <div class="item_title">
                                                    <h3>{{ $restaurant->name }}</h3>
                                                    <small>{{ $restaurant->location }}</small>
                                                    {{-- <small>{{ $restaurant->description }}</small> --}}
                                                </div>
                                            </a>
                                        </figure>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                <!-- /carousel -->
            </div>
        @endisset

	</main>
	<!-- /main -->


    <script type="text/javascript">

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        function showPosition(position) {
            document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Veuillez autoriser l'accès à votre position pour continuer.");
                    // ❌ Supprimé : location.reload() — c'était la cause de la boucle
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Votre position est indisponible.");
                    break;
                case error.TIMEOUT:
                    alert("La requête de géolocalisation a expiré.");
                    break;
            }
        }

        getLocation();

    </script>
@endsection
