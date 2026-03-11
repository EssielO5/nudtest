@extends('admin.master')
@section('admin')
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
                    <h2>Configuration FedaPay Mode</h2>
                </div>
                @if ($payment)
                    <form action="{{ route('admin.handle_payment_environment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Choisir Environnement</label>
                            <select name="mode" id="mode" class="form-control">
                                <option @selected($payment->mode == "sandbox") value="sandbox">Sandbox</option>
                                <option @selected($payment->mode == "live") value="live">Live</option>
                            </select>

                            @error('mode')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <input type="submit"class="btn btn-warning" value="Modifier" href="{{ route('restaurant.update') }} ">
                    </form>
                @endif
                </div>
            </div>

        </div>
        <!-- /row-->
    </div>
    <!-- /.container-fluid-->
@endsection
