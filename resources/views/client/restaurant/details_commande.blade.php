@extends('client.master')
@section('client')

    <main>
        <div class="container margin_detail">
            <div class="row">
                <h3 style="text-align: center">Détails de la commande</h3><br>
                @if ($order == null)
                    <br><br><br>
                    <h5 style="text-align: center" class="text-danger"> Commande non trouvé</h5>
                    <br><br><br>
                @else
                    <p><strong>Nom</strong> : {{ $order->name }}</p>
                    <p><strong>Adresse</strong>: {{ $order->adresse }}/{{ $order->phone }}</p>
                    <p><strong>Date</strong>: {{ $order->created_at }}</p>
                    <p><strong>Restaurant</strong>: {{ $order->restaurant->name }}</p>
                    <br>
                    <div
                        class="table-responsive"
                        >
                        <table
                            class="table table-striped table-hover table-borderless  align-middle"
                        >
                            <thead class="table-light">

                                <tr>
                                    <th></th>
                                    <th>Plat</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                @foreach ($order_plats as $plat)
                                    <tr
                                    >
                                        <td><img src="{{ asset('images/plats/'.$plat['1']) }}" alt="" height="50px" width="50px"></td>
                                        <td>{{ $plat['0'] }}</td>
                                        <td>{{ $plat['2'] }}</td>
                                        <td>{{ $plat['3'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>Total : {{ $order->montant_total }} fcfa</strong></td>
                                </tr>
                            </tfoot>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </main>


@endsection
