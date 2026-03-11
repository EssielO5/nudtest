@extends('admin.master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Clients</li>
            </ol>

            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="float-left"><i class="fa fa-table"></i> Ajouter un client</h5>
                    <a class="float-right btn btn-danger" href="{{ route('Admin.clients') }}">Retour</a>
                </div>
                <div class="card-body">
                    <div class="box_general padding_bottom">

                    <form method="post" action="{{ route('Admin.client.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom du Client</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email du Client</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Numero de téléphone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                    </div>
                    <!-- /row-->


                    <!-- /row-->
                    <button class="btn_1 medium" type="submit">Créer un client</button>
                    </form>

            <!-- /tables-->
        </div>
        <!-- /container-fluid-->
    </div>

@endsection
