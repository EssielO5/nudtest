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
                <li class="breadcrumb-item active">Ajouter un menu </li>
            </ol>

            <!-- /box_general-->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-file"></i>Nouveau menu</h2>
                </div>
                <form method="post" action="{{ route('restaurant.menu.store') }}">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nom du menu <span class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control" name="text" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="restaurant_id" value="{{ Auth::guard('restaurant')->user()->id }}">
                    <!-- /row-->
                    <button class="btn_1 medium" type="submit">Créer un menu</button>
                </form>
            </div>

        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->
@endsection
