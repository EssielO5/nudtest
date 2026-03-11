@extends('restaurant.master')
@section('restaurant')

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
                    <div class="table-responsive">
                        <table class="" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                @foreach (Auth::guard('restaurant')->user()->unreadnotifications as $notification)
                                    <tr class=" ">
                                        <td class="text-center p-2">{{ $notification->data['message'] }}</></td>
                                        <td class="text-center p-2">Nom: {{ $notification->data['name'] }}</Nom:></td>
                                        <td class="text-center p-2">Qte: {{ $notification->data['adresse'] }}</td>
                                        <td class="text-center p-2">Tel: {{ $notification->data['phone'] }}</td>
                                        <td class="text-center p-2">{{ $notification->data['montant_total'] }} fcfa</td>
                                        <td class="text-center p-2">
                                            <a href="{{ route('restaurant.mark_as_read', $notification->id) }}" class="btn btn-danger">Marqué comme lu</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
            </div>


        </div>
    </div>
@endsection
