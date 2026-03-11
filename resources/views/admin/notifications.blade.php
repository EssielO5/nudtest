@extends('admin.master')
@section('admin')

<div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Notifications</li>
            </ol>
            <!-- Icon Cards-->

            <br>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Mes notifications
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach (Auth::guard('admin')->user()->unreadnotifications as $notification)
                            <div class="col-4">
                                <div class="card">


                                    <div class="card-body">
                                        <p class="card-text bg-danger text-white text-center">{{ $notification->data['message'] }}</p>
                                        <img class="" src=" {{ asset('images/restaurants/'.$notification->data['image'])  }}" alt="Restaurant name" width="150px" />
                                        <div class="card-text"><b>Nom :</b> {{ $notification->data['name'] }} </div>
                                        <div class="card-text"><b>Contact :</b> {{ $notification->data['phone'] }}</div>
                                        <div class="card-text"><b>Email :</b> {{ $notification->data['email'] }}</div>
                                        <div class="card-text"><b>Adresse </b>: {{ $notification->data['location'] }}</div>
                                        <br>
                                        <div>
                                            <a href="{{ route('admin.active_restaurant', [$notification->id, $notification->data['restaurant_id']]) }}" class="btn btn-primary">Approuvé</a>
                                                    <a href="{{ route('admin.refuse_restaurant', [$notification->id, $notification->data['restaurant_id']]) }}" class="btn btn-danger">Refusé</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
