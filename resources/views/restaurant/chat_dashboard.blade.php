@extends('restaurant.master')
@section('restaurant')
<div class="content-wrapper">
        <div class="container-fluid">
            <h5>Liste des clients</h5>
            <ul>
                @foreach ($clients as $client)
                    <li><a href="{{ route('restaurant.chat', $client->id) }}">{{ $client->name }}</a></p></li>
                @endforeach
            </ul>

        </div>
</div>
@endsection
