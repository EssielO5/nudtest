@extends('client.master')
@section('client')


    <main>
        <div  class="container-fluid">
            <div class="row mb-2">
                <marquee behavior="scroll" direction="left" scrollamount="08" class="p-2 bg-danger"><h5 class="text-white">Ce plat est la spécialité du restaurant <span class=" text-bold">{{ $restaurant->name }}</span></h5></marquee>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $init=0; ?>
                            @for ($i = 0; $i < 3; $i++)

                                <?php if ($init==0) {$set_ = 'active'; } else {$set_ = ''; } ?>
                                    <div class=" carousel-item <?php echo $set_; ?>" data-bs-interval="2000">
                                        <img src="{{ asset('images/plats/'.$plat->image) }}" style="height:400px" class="d-block w-100"  alt="Image du plat">
                                    </div>

                                <?php $init++; ?>
                            @endfor



                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="table-responsive ">
                        <table class="table table-primary align-middle ">
                            <thead class="table-light">
                                <tr>
                                    <th>Catégorie</th>
                                    <th>{{ $plat->category->name }}</th>
                                </tr>
                                <tr>
                                    <th>Nom du plat</th>
                                    <th>{{ $plat->name }}</th>
                                </tr>
                                @if ($plat->description)
                                    <tr>
                                        <th>Description</th>
                                        <th>{{ $plat->description }}</th>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Prix</th>
                                    <th>{{ $plat->price }} fcfa</th>
                                </tr>
                                <tr>
                                    <th>Nom du Restaurant</th>
                                    <th>{{ $restaurant->name }}</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class=""><a class="btn btn-success" href="{{ route('client.add_to_cart', $plat->id) }}">Ajouter au panier</a></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection
