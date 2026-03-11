@extends('admin.master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Restaurants</li>
            </ol>

            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="float-left"><i class="fa fa-table"></i> Ajouter un restaurant</h5>
                    <a class="float-right btn btn-danger" href="{{ route('Admin.restaurants') }}">Retour</a>
                </div>
                <div class="card-body">
                    <div class="box_general padding_bottom">

                    <form method="post" action="{{ route('Admin.restaurant.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom du Restaurant</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email du Restaurant</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresse / Localisation</label>
                                <input type="text" class="form-control" name="location">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Numero de téléphone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                    </div>
                    <!-- /row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                    </div>

                            <div class="form-group">
                                <label>Image du restaurant</label>
                                <input type="file" accept="image/*" class="form-control" name="image" required>
                            </div>
                    <!-- /row-->
                    <button class="btn_1 medium" type="submit">Créer un restaurant</button>
                    </form>

            <!-- /tables-->
        </div>
        <!-- /container-fluid-->
    </div>

@endsection
