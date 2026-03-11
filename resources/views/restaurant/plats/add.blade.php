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
                <li class="breadcrumb-item active">Ajouter un plat </li>
            </ol>

            <!-- /box_general-->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-file"></i>Nouveau plat</h2>
                </div>
                <form method="post" action="{{ route('restaurant.plat.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Choisir Catégorie <span class="text-danger">*</span> </label>
                                <select name="category_id" id="" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom du plat <span class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control" name="text" required>
                            </div>
                        </div>

                    </div>
                    <!-- /row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prix <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" accept="image/*" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="restaurant_id" value="{{ Auth::guard('restaurant')->user()->id }}">
                    <!-- /row-->
                    <button class="btn_1 medium" type="submit">Créer un plat</button>
                </form>
            </div>

        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->
@endsection
