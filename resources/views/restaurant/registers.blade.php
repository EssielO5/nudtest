@extends('master')
@section('guest')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>
        <title>Nùdutin - Attirez de nouveaux clients</title>

    </head>
    <body>


        <main>

            <div class="bg_gray pattern" id="submit">
                <div class="container margin_60_40">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center add_bottom_15">
                                <h4>Veuillez remplir le formulaire ci-dessous</h4>
                                <p>pour créer un compte Restaurant</p>
                            </div>
                            <div id="message-register"></div>
                            <form method="post" action="{{ route('restaurant.register.create') }}" enctype="multipart/form-data">
                                @csrf
                                <h6>Données personnelles</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Nom du resto *" value="{{ old('name') }}" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row add_bottom_15">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Emplacement du resto" value="{{ old('location') }}" name="location">
                                            @error('location')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Téléphone" value="{{ old('phone') }}" name="phone">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row add_bottom_15">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Description du resto" value="{{ old('description') }}" name="description">
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <h5>Indiquez votre position sur la carte</h5>
                                            @error('latitude')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div id="map" style="width: 100%; height:400px;border-radius: 10px;"></div>

                                            <input type="hidden" name="latitude" id="latitude">
                                            <input type="hidden" name="longitude" id="longitude">

                                        </div>
                                    </div>
                                </div>

                                <!-- /row -->
                                <h6>Login et mot de passe</h6>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Adresse e-mail *" value="{{ old('email') }}" name="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- /row -->
                                <div class="row add_bottom_15">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Mot de passe *" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Confirmez le mot de passe *" name="password_confirmation">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group text-center"><input type="submit" class="btn_1" value="Soumettre"
                                        id="submit-register"></div>
                                <div class="text-center dont-have">Vous avez déjà un compte ? <a href="{{ route('login_form') }}">Connexion</a></div><br>


                            </form>
                        </div>
                    </div>
                </div>
                <!-- /container -->
            </div>

        </main>
        <!-- /main -->


        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>


        <script>


            let mapOptions = {
                center:[6.380000114440918, 2.4000000953674316],
                zoom:10
            }

            let map = new L.map('map' , mapOptions);

            let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
            map.addLayer(layer);


            let marker = null;
            map.on('click', (event)=> {

                if(marker !== null){
                    map.removeLayer(marker);
                }

                marker = L.marker([event.latlng.lat , event.latlng.lng]).addTo(map);

                document.getElementById('latitude').value = event.latlng.lat;
                document.getElementById('longitude').value = event.latlng.lng;

            })

        </script>

@endsection





