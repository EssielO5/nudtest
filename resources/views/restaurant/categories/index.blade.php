@extends('restaurant.master')
@section('restaurant')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Catégories</li>
            </ol>

            <!-- Example DataTables Card-->
            {{-- <a class="btn_1 medium" href="{{ route('restaurant.table.create') }}">Ajouter un plat</a></br> --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="float-left"><i class="fa fa-table"></i> Liste des catégories</h5>
                    <a href="{{ route('restaurant.category.add') }}" class="float-right btn btn-primary">Ajouter</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Menu</th>
                                    <th>Nom de la catégorie</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($menus_restaurants as $menus_restaurant)
                                    @foreach ($menus_restaurant->categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->menu->name }} </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                <a data-toggle="modal"
                                                    href="#detailsModal_{{ $category->id }}"><strong>Modifier</strong></a> | <a
                                                    data-toggle="modal"
                                                    href="#deleteModal_{{ $category->id }}"><strong>Supprimer</strong></a>
                                            </td>
                                        </tr>


                                    <!-- details Modal-->
                                    <div class="modal fade" id="detailsModal_{{ $category->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Détails de la catégorie
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Voici tous les détails sur la catégorie <strong>
                                                    {{ $category->id }}</strong></br></br>
                                                    <form action="{{ route('restaurant.category.update') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Choisir un menu <span class="text-danger">*</span> </label>
                                                            <select class="form-control" name="menu_id" required>
                                                                @foreach ($menus as $menu)
                                                                    <option @selected(old('menu_id', $category->menu_id) == $menu->id) value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group"><label>Nom de la catégorie</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="description" id="" class="form-control">{{ $category->description }}</textarea>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <input type="submit"class="btn btn-success" value="Modifier">
                                                    </form>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="deleteModal_{{ $category->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal_{{ $category->id }}">Supprimer
                                                        la catégorie</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Sélectionnez "supprimer" ci-dessous si vous êtes
                                                    prêt à supprimer cette catégorie : {{ $category->name }}</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('restaurant.category.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <input type="submit"class="btn btn-danger" value="Supprimer">

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /tables-->
        </div>
        <!-- /container-fluid-->
    </div>
@endsection
