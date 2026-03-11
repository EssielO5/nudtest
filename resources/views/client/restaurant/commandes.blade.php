@extends('client.master')
@section('client')

    <main>
        <div class="container margin_detail">
            <div class="row">
                <h3 >Mes commandes</h3><br>
                @if ($commandes == null)
                    <br><br><br>
                    <h5 style="text-align: center"> Aucune commande disponible pour vous</h5>
                    <br><br><br>
                @else

                    <div
                        class="table-responsive"
                        >
                        <table
                            class="table table-striped table-hover table-borderless  align-middle"
                        >
                            <thead class="table-light">

                                <tr>
                                    <th>Reference</th>
                                    <th>Restaurant</th>
                                    <th>Client</th>
                                    <th>Contact</th>
                                    <th>Livraison</th>
                                    <th>Montant (fcfa)</th>
                                    <th>Date</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($commandes as $commande)
                                    <tr

                                    >
                                        <td>CMD000{{ $commande->id }}</td>
                                        <td>{{ $commande->restaurant->name }}</td>
                                        <td>{{ $commande->name }}</td>
                                        <td>{{ $commande->phone }}</td>
                                        <td>{{ $commande->adresse }}</td>
                                        <td>{{ $commande->montant_total }}</td>
                                        <td>{{ $commande->created_at }}</td>

                                        <td class="text-center fs-5">
                                            <a href="{{ route('client.commandes.details', $commande->id) }}" class="text-primary "><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                        <td class="text-center fs-5">
                                            <a href="{{ route('client.generate_commande_pdf', $commande->id) }}" class="text-danger"><i class="fa-solid fa-file-pdf"></i></a>
                                        </td>
                                        <td class="text-center fs-5">
                                            <a href="{{ route('client.commandes.comment', $commande->id) }}" class="text-black"> <i class="fa fa-comment" ></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                        {{ $commandes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>


@endsection
