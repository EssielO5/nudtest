@extends('restaurant.master')
@section('restaurant')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Détails Commande</li>
            </ol>

            <p><strong>Nom</strong> : {{ $order->name }}</p>
            <p><strong>Adresse</strong>: {{ $order->adresse }}/{{ $order->phone }}</p>
            <p><strong>Date</strong>: {{ date('d-m-Y  à  H:i:s', strtotime($order->created_at)) }}</p>

            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="float-left"><i class="fa fa-table"></i> Détails de la commande</h6>
                    <a href="{{ route('restaurant.orders') }}" class="float-right btn btn-primary">Retour</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Plat</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($order_plats as $plat)
                                    <tr>
                                        <td><img src="{{ asset('images/plats/'.$plat['1']) }}" alt="" height="50px" width="50px"></td>
                                        <td>{{ $plat['0'] }}</td>
                                        <td>{{ $plat['2'] }}</td>
                                        <td>{{ $plat['3'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"><b>Total : {{ $order->montant_total }} fcfa</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /tables-->
        </div>
        <!-- /container-fluid-->
    </div>
@endsection
