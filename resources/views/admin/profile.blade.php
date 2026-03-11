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
                <li class="breadcrumb-item active">Mon profi</li>
            </ol>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>Détails du profil</h2>
                </div>
                <form action="{{ route('admin.profile_update') }}" method="POST">
                    <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" name="id">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <img src="{{ asset('img/manager.png') }}" width="170" height="170"></img>
                            </div>
                        </div>

                        <div class="col-md-8 add_top_30">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::guard('admin')->user()->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ Auth::guard('admin')->user()->email }}" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name='password' value="">
                                    </div>
                                </div>

                            </div>

                            <!-- /row-->
                            {{-- <p><a href="#0" class="btn_1 medium">Save</a></p> --}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </form>
            </div>

        </div>
        <!-- /row-->
    </div>
    <!-- /.container-fluid-->
