@extends('restaurant.master')
@section('restaurant')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Menus</li>
            </ol>

            <!-- Example DataTables Card-->
            {{-- <a class="btn_1 medium" href="{{ route('restaurant.table.create') }}">Ajouter un plat</a></br> --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="float-left"><i class="fa fa-table"></i> Liste des menus</h5>
                    <a href="{{ route('restaurant.menu.add') }}" class="float-right btn btn-primary">Ajouter</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom du Menu</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->id }} </td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->description }}</td>
                                        <td>
                                            <a data-toggle="modal"
                                                href="#detailsModal_{{ $menu->id }}"><strong>Modifier</strong></a> | <a
                                                data-toggle="modal"
                                                href="#deleteModal_{{ $menu->id }}"><strong>Supprimer</strong></a>
                                        </td>
                                    </tr>
                                    <!-- details Modal-->
                                    <div class="modal fade" id="detailsModal_{{ $menu->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Détails du menu
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Voici tous les détails sur le menu <strong>
                                                    {{ $menu->id }}</strong></br></br>
                                                    <form action="{{ route('restaurant.menu.update') }}" method="POST">
                                                        @csrf
                                                        <label>Nom du Menu</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $menu->name }}"></br>
                                                        <label>Description</label>
                                                        <textarea name="description" id="" class="form-control">{{ $menu->description }}</textarea>
                                                        </br>
                                                        <input type="hidden" name="id" value="{{ $menu->id }}">
                                                        <input type="submit"class="btn btn-success" value="Modifier">
                                                    </form>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="deleteModal_{{ $menu->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal_{{ $menu->id }}">Supprimer
                                                        le menu</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Sélectionnez "supprimer" ci-dessous si vous êtes
                                                    prêt à supprimer ce menu : {{ $menu->name }}</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('restaurant.menu.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $menu->id }}">
                                                        <input type="submit"class="btn btn-danger" value="Supprimer">

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
