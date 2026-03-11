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
                    <h5 class="float-left"><i class="fa fa-table"></i> Liste des restaurants</h5>
                    <a class="float-right btn btn-primary" href="{{ route('Admin.restaurants.add') }}">Ajouter</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-center">Image</th>
                                    <th>Restaurant</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>Contrôle</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($restaurants as $restaurant)
                                    <tr>
                                        <td>{{ $restaurant->id }} </td>
                                        <td class="text-center"><img src="{{ asset('images/restaurants/'.$restaurant->image) }} " alt="Restaurant Image" width="50px" height="50px"></td>
                                        <td>{{ $restaurant->name }} </td>
                                        <td>
                                            @if ($restaurant->status == 1)
                                                <span class="text-success">Activé</span>
                                            @else
                                                <span class="text-danger">Désactivé</span>
                                            @endif
                                        </td>
                                        <td>{{ $restaurant->email }}</td>
                                        <td><a data-toggle="modal" href="#detailsModal_{{ $restaurant->id }}"><strong>Modifier
                                                    </strong></a> | <a data-toggle="modal"
                                                href="#deleteModal_{{ $restaurant->id }}"><strong>Supprimer</strong></a>
                                        </td>
                                    </tr>
                                    <!-- details Modal-->
                                    <div class="modal fade" id="detailsModal_{{ $restaurant->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifier restaurant
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Voici tous les détails sur le restaurant<strong>
                                                        {{ $restaurant->name }}</strong></br></br>
                                                        <form action="{{ route('restaurant.update') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label>Nom du Restaurant</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control"
                                                                        value="{{ $restaurant->name }}" required>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control"
                                                                        value="{{ $restaurant->email }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label>Localisation</label>
                                                                    <input type="text" name="location"
                                                                        class="form-control"
                                                                        value="{{ $restaurant->location }}">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label>Téléphone</label>
                                                                    <input type="text" name="phone"
                                                                        class="form-control"
                                                                        value="{{ $restaurant->phone }}">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control">{{ $restaurant->description }}</textarea>
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
                                                                    <input type="hidden" name="hidden_restaurant_image" value="{{ $restaurant->image }}">
                                                                    <input type="file" accept="image/*" name="image" class="form-control">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label>Status du compte</label>
                                                                    <select name="status" id="status" class="form-control">
                                                                        <option value="1" @selected($restaurant->status == 1)>Activé</option>
                                                                        <option value="0" @selected($restaurant->status == 0)>Désactivé</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="id" value="{{ $restaurant->id }}">
                                                            <input type="submit"class="btn btn-success" value="Modifier" href="{{ route('restaurant.update') }} ">
                                                        </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="deleteModal_{{ $restaurant->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal_{{ $restaurant->id }}">Supprimer restaurant</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Sélectionnez "supprimer" ci-dessous si vous êtes prêt à supprimer ce restaurant : {{ $restaurant->name }}</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('restaurant.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $restaurant->id }}">
                                                            <input type="submit"class="btn btn-danger" value="Supprimer" href="{{ route('restaurant.delete') }} ">

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
