@extends('client.master')
@section('client')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <main>

        <div class="container margin_detail">
            <div class="row">
                <div class="col-md-8">

                    @if ( count((array) session('cart')) == 0)
                        <h5> Vôtre panier est vide</h5>
                    @else
                        <table id="cart"
                            class="table table-hover table-condensed"
                            >
                            <thead>
                                <tr>
                                    <th style="width:50%">Image</th>
                                    <th style="width:10%">Prix</th>
                                    <th style="width:8%">Qte</th>
                                    <th style="width:22%" class="text-center">Sous-total</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $id => $details)
                                        @php $restaurant_id = $details['restaurant_id'] @endphp
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr data-id="{{ $id }}">
                                            <td data-th="Plat">
                                                <div class="row">
                                                    <div class="col-sm-3 hidden-xs"><img src="{{ asset('images/plats/'.$details['image']) }}" alt="" width="50px" height="50px"></div>
                                                    <div class="col-sm-9">
                                                        <h5 class="">{{ $details['plat_name'] }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-th="Price" >{{ $details['price'] }}</td>
                                            <td data-th="Quantity" class="text-center">
                                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1">
                                            </td>
                                            <td data-th="Subtotal" class="text-center">{{ $details['price'] * $details['quantity'] }} fcfa</td>
                                            <td class="actions" data-th="">
                                                <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><h5><strong>Total : {{ $total }} fcfa</strong></h5></td>
                                </tr>
                            </tfoot>
                        </table>

                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('client.initPayment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">
                                <input type="hidden" name="client_id" value="{{ Auth::guard('client')->user()->id }}">
                                <input type="hidden" name="montant_total" value="{{ $total }}">
                                <div class="form-group">
                                    <label for="name">Nom du client</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::guard('client')->user()->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Numéro de téléphone</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::guard('client')->user()->phone) }}"  class="form-control" required>
                                    <small>Ex : +22964000001</small> <br>
                                    @error('phone')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Adresse de livraison</label>
                                    <input type="text" name="adresse" id="adresse" value="{{ old('adresse', Auth::guard('client')->user()->adresse) }}"  class="form-control" required>
                                    @error('adresse')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                @error('montant_total')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <a href="{{ url('/restaurants') }}" class="btn btn-danger"> Continue l'achat</a>
                                <button class="btn btn-success" type="submit">Procéder au paiement</button>
                            </form>
                        </div>
                    @endif
            </div>
            <!-- /row -->
        </div>

    </main>

<script type="text/javascript">
        $(".cart_update").change(function(e) {
            e.preventDefault();

            var element = $(this);

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: element.parents("tr").attr("data-id"),
                    quantity: element.parents("tr").find(".quantity").val()
                },
                success: function(response){
                    window.location.reload();
                }
            })
        })
        $(".cart_remove").click(function(e) {
            e.preventDefault();

            var element = $(this);

            if(confirm("Voulez-vous vraiment retirer ce plat du panier ?")) {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: element.parents("tr").attr("data-id")
                    },
                    success: function(response){
                        window.location.reload();
                    }
                })
            }
        })
    </script>

@endsection

{{-- @section('scripts') --}}

{{-- @endsection --}}
