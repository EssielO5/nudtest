@extends('restaurant.master')
@section('restaurant')
    <!-- /Navigation-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Mon profil</li>
            </ol>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>Détails du profil</h2>
                </div>
                {{-- <div class="row"> --}}
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Your photo :</label><br>
                            <img src="{{ asset('img/resto_user.png') }}" width="170" height="170"></img>
                        </div>
                    </div> --}}
                {{-- </div> --}}

                    <form action="{{ route('restaurant.update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Nom du Restaurant</label>
                                <input type="text" name="name"
                                    class="form-control"
                                    value="{{ Auth::guard('restaurant')->user()->name }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control"
                                    value="{{ Auth::guard('restaurant')->user()->email }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Localisation</label>
                                <input type="text" name="location"
                                    class="form-control"
                                    value="{{ Auth::guard('restaurant')->user()->location }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Téléphone</label>
                                <input type="text" name="phone"
                                    class="form-control"
                                    value="{{ Auth::guard('restaurant')->user()->phone }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ Auth::guard('restaurant')->user()->description }}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input type="password" name="password"
                                    class="form-control"
                                    value="">
                                    <small>Laissez ce champ vide si vous ne compter pas le modifier</small>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Image</label>
                                <input type="hidden" name="hidden_restaurant_image" value="{{ Auth::guard('restaurant')->user()->image }}">
                                <input type="file" accept="image/*" name="image" class="form-control">
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ Auth::guard('restaurant')->user()->id }}">
                        <input type="submit"class="btn btn-success" value="Modifier" href="{{ route('restaurant.update') }} ">
                </form>
                </div>
            </div>

        </div>
        <!-- /row-->
    </div>
    <!-- /.container-fluid-->
@endsection
