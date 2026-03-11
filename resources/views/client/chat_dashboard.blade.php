@extends('client.master')
@section('client')
<div class="content-wrapper">
    <div class="container-fluid">
        <h5>Liste des restaurants</h5>
        <ul>
            @foreach ($restaurants as $restaurant)
                <li><a href="{{ route('client.chat', $restaurant->id) }}">{{ $restaurant->name }}</a></p></li>
            @endforeach
        </ul>

    </div>
</div>
@endsection
