@extends('restaurant.master')
@section('restaurant')
    <!-- /Navigation-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Clé de paiement</li>
            </ol>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>Configuration FedaPay</h2>
                </div>

                    <form action="{{ route('restaurant.handle_payment_keys') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Clé publique</label>
                            <input type="text" name="public_key"
                                class="form-control"
                                value="{{ isset($payment_gateway) ? $payment_gateway->public_key : '' }}" required>

                            @error('public_key')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Clé privée</label>
                            <input type="text" name="private_key"
                                class="form-control"
                                value="{{ isset($payment_gateway) ? $payment_gateway->private_key : '' }}" required>
                            @error('private_key')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <input type="submit"class="btn btn-success" value="{{ isset($payment_gateway) ? 'Modifier' : 'Ajouter' }}" href="{{ route('restaurant.update') }} ">
                    </form>
                </div>
            </div>

        </div>
        <!-- /row-->
    </div>
    <!-- /.container-fluid-->
@endsection
