@extends('client.master')
@section('client')
    <!-- /Navigation-->

    <main>
        <div class="container margin_detail">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Mon profil</li>
                </ol>
                <div class="box_general padding_bottom">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img src="{{ asset('img/resto_user.png') }}" width="170" height="170"></img>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('client.update.profile') }}" class="mb-4" method="POST">
                                @csrf
                                <div class="row col-md-12">
                                    <div class="col-md-6 form-group">
                                        <label>Nom du client</label>
                                        <input type="text" name="name"
                                            class="form-control"
                                            value="{{ Auth::guard('client')->user()->name }}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-control"
                                            value="{{ Auth::guard('client')->user()->email }}" required>
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="col-md-6 form-group">
                                        <label>Téléphone</label>
                                        <input type="text" name="phone"
                                            class="form-control"
                                            value="{{ Auth::guard('client')->user()->phone }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Password</label>
                                        <input type="password" name="password"
                                            class="form-control"
                                            value="">
                                            <small>Laissez ce champ vide si vous ne compter pas le modifier</small>
                                    </div>
                                </div>

                                <div class="col-md-2 form-group">
                                    <input type="hidden" name="id" value="{{ Auth::guard('client')->user()->id }}">
                                    <input type="submit"class="btn btn-success" value="Modifier" href="{{ route('client.update.profile') }} ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </main>
    <!-- /.container-fluid-->
@endsection
