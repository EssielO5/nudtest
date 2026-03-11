@extends('client.master')
@section('client')
    <title>Resto - Découvrez les restaurants</title>
    <main>
        <div class="hero_single version_4">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Liste des plats du restaurants <span class=" text-bold text-primary">{{ $restaurant->name }}</span></h1>
                            <br>
                            <a href="{{ route('client.chat', $restaurant->id) }}" class="btn btn-danger text-bold">Discuter avec ce restaurant</a>
                            {{-- <form method="post" action="grid-listing-filterscol.html">
								<div class="row g-0 custom-search-input">
									<div class="col-lg-4">
										<div class="form-group">
											<input class="form-control" type="text" placeholder="What are you looking for...">
											<i class="icon_search"></i>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input class="form-control no_border_r" type="text" placeholder="Address, neighborhood...">
											<i class="icon_pin_alt"></i>
										</div>
									</div>
									<div class="col-lg-2">
										<input type="submit" value="Search">
									</div>
								</div>
								<!-- /row -->
							</form> --}}
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>
        <div class="page_header element_to_stick">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Accueil</a></li>
                                <li><a >Voir les plats</a></li>

                            </ul>
                        </div>
                    </div>
                    {{-- <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="search_bar_list">
                            <input type="text" class="form-control" placeholder="Search again...">
                            <input type="submit" value="Search">
                        </div>
                    </div> --}}
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /page_header -->
{{--
        <div class="filters_full clearfix add_bottom_15">
            <div class="container">
                <div class="switch-field">
                    <input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*"
                        class="selected">
                    <label for="all">All</label>
                    <input type="radio" id="popular" name="listing_filter" value="popular" data-filter=".popular">
                    <label for="popular">Popular</label>
                    <input type="radio" id="latest" name="listing_filter" value="latest" data-filter=".latest">
                    <label for="latest">Latest</label>
                </div>
            </div>
        </div> --}}
        <!-- /filters_full -->


        @if (count($plats) == 0)
            <br><br>
            <h5 style="text-align: center"> Aucun plat disponible pour ce restaurant</h5>
            <br><br>
        @else

            <div class="container margin_30_40">
                <div class="row isotope-wrapper">
                    @foreach ($plats as $plat)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 isotope-item popular">
                        <div class="strip">
                            <figure>
                                <img src="{{ asset('images/plats/'. $plat->image) }}" data-src="{{ asset('images/plats/'. $plat->image) }}" class="img-fluid lazy" alt="Image du restaurant">


                                <a href="{{ route('client.show_plat', $plat->id) }}" class="strip_info">
                                    <small>{{ $plat->name }}</small>
                                    <div class="item_title">
                                        <h3>{{ $plat->name }}</h3>
                                        <small>{{ $plat->price }} fcfa</small>
                                        {{-- <small>{{ $restaurant->description }}</small> --}}
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><a class="loc_open" href="{{ route('client.add_to_cart', $plat->id) }}">Ajouter au panier</a></li>

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
                <div class="pagination_fg">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
            <!-- /container -->
        @endif

    </main>



    <!-- /main -->
@endsection
