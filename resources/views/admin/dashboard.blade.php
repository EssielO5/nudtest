@extends('admin.master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card dashboard text-white bg-primary o-hidden h-100">
                        <div class="card-body">

                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-calendar-check-o"></i>
                            </div>
                            <div class="mr-5">
                                <h5>{{ $nbr_resto }} Restaurants !</h5>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="{{ route('Admin.restaurants') }}">
                            <span class="float-left">Voir les détails</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card dashboard text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-calendar-check-o"></i>
                            </div>
                            <div class="mr-5">
                                <h5>{{ $nbr_client }} Clients !</h5>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="{{ route('Admin.clients') }}">
                            <span class="float-left">Voir les détails</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <br>
                        <!-- Example DataTables Card-->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>

                                                <th>Restaurant</th>
                                                {{-- <th class="text-right">Nombre de clients</th> --}}
                                                <th class="text-right">Nombre de commandes</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($restaurants as $restaurant)
                                            <tr>
                                                    <td>{{ $restaurant->name }} </td>
                                                    {{-- <td  class="text-right">{{ $restaurant->orders->count() }} </td> --}}
                                                    <td  class="text-right">{{ $restaurant->orders->count() }} </td>
                                                </tr>
                                                @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
                        </div>


        </div>
    </div>
@endsection
