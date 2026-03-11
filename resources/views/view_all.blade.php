@extends('master')
@section('guest')
    <title>Nùdutin - Découvrez les restaurants</title>
    <main>
        <div class="hero_single version_4">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Liste des restaurants</h1>
                            <p>Nous avons sélectionné pour vous les restaurants qui vous conviennent</p>
                            <form>
                                <div class="row g-0 custom-search-input">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="search" placeholder="Rechercher par nom ou adresse du restaurant..." value="{{ $input['search'] ?? '' }}">
                                            <i class="icon_search"></i>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" placeholder="Address, neighborhood...">
                                            <i class="icon_pin_alt"></i>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-2">
                                        <input type="submit" value="Rechercher">
                                    </div>
                                </div>
                                <!-- /row -->
                            </form>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>


        <div class="container margin_30_40">
            <div class="row isotope-wrapper">
                <div class="pagination_fg">
                {{ $restaurants->links() }}
            </div>
                @foreach ($restaurants as $restaurant)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 isotope-item popular">
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

                            {{-- <li><span>Avg. Price 24$</span></li> --}}
                            <li>
                                {{-- <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div> --}}
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </main>
@endsection
