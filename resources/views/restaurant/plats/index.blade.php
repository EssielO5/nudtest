@extends('restaurant.master')
@section('restaurant')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Plats</li>
            </ol>

            <!-- Example DataTables Card-->
            {{-- <a class="btn_1 medium" href="{{ route('restaurant.table.create') }}">Ajouter un plat</a></br> --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="float-left"><i class="fa fa-table"></i> Liste des plats</h5>
                    <a href="{{ route('restaurant.plat.add') }}" class="float-right btn btn-primary">Ajouter</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th></th>
                                    <th class="text-center">Image</th>
                                    <th>Catégorie</th>
                                    <th>Nom du Plat</th>
                                    <th>Prix</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody class="text-center">
                                @foreach ($plats as $plat)
                                    <tr>
                                        <td>{{ $plat->id }} </td>
                                        <td class="text-center">
                                            <img src="{{ asset('images/plats/'.$plat->image) }}" alt="" width="100px" height="50px">
                                        </td>
                                        <td>{{ $plat->category->name }} </td>
                                        <td>{{ $plat->name }}</td>
                                        <td>{{ $plat->price }}</td>
                                        <td>
                                            @if ($plat->status != 0)
                                                <span class="text-success">Disponible</span>
                                            @else
                                                <span class="text-danger">Indisponible</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a data-toggle="modal"
                                                href="#detailsModal_{{ $plat->id }}"><strong>Modifier</strong></a> | <a
                                                data-toggle="modal"
                                                href="#deleteModal_{{ $plat->id }}"><strong>Supprimer</strong></a>
                                        </td>
                                    </tr>
                                    <!-- details Modal-->
                                    <div class="modal fade" id="detailsModal_{{ $plat->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Détails du plat
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Voici tous les détails sur le plat <strong>
                                                    {{ $plat->id }}</strong></br></br>
                                                    <form action="{{ route("restaurant.plat.update") }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Choisir Catégorie <span class="text-danger">*</span> </label>
                                                                    <select name="category_id" id="" class="form-control">
                                                                        @foreach ($categories as $category)
                                                                            <option @selected(old('category_id', $category->id) == $plat->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Nom du plat <span class="text-danger">*</span> </label>
                                                                    <input type="text" name="name" class="form-control" name="text" value="{{ $plat->name }}" required>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- /row-->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Prix <span class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control" name="price" value="{{ $plat->price }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" accept="image/*" class="form-control" name="image">
                                                                    <input type="hidden" name="hidden_plat_image" value="{{ $plat->image }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="description" id="description" class="form-control">{{ $plat->description }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Status</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="1" @selected($plat->status == 1)>Activé</option>
                                                                <option value="0" @selected($plat->status == 0)>Désactivé</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $plat->id }}">
                                                        <input type="hidden" name="restaurant_id" value="{{ Auth::guard('restaurant')->user()->id }}">
                                                        <!-- /row-->
                                                        <button class="btn_1 medium" type="submit">Modifier un plat</button>
                                                    </form>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="deleteModal_{{ $plat->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal_{{ $plat->id }}">Supprimer
                                                        le plat</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Sélectionnez "supprimer" ci-dessous si vous êtes
                                                    prêt à supprimer ce plat : {{ $plat->name }}</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('restaurant.plat.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $plat->id }}">
                                                        <input type="submit"class="btn btn-danger" value="Supprimer"
                                                            href="{{ route('restaurant.plat.delete') }} ">
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
