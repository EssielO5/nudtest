@extends('restaurant.master')
@section('restaurant')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Commandes</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="float-left"><i class="fa fa-table"></i> Liste des commandes</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Nom</th>
                                    <th>Contact</th>
                                    <th>Adresse</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>CMD00{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->adresse }}</td>
                                        <td>{{ $order->montant_total }} fcfa</td>
                                        <td>{{ date('d-m-Y  H:i:s', strtotime($order->created_at)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('restaurant.orders.details', $order->id) }}" class="btn btn-primary">Voir détails</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('restaurant.orders.comment', $order->id) }}" class="btn btn-secondary">Voir commentaire</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
            <!-- /tables-->
        </div>
        <!-- /container-fluid-->
    </div>
@endsection
