@extends('client.master')
@section('client')
    <main>

        <div class="container margin_detail">
            <div class="row">
                @if ($comment)
                    <h3>Commentaire de {{ $comment->client->name }}</h3>

                    <div class="col-md-8 mt-4 mb-4">
                        <ul>
                            <li>{{ $comment->comment }} <em><a class="text-danger" href="{{ route('restaurant.chat', $comment->client_id) }}">Répondre en message privé</a></em></li>
                        </ul>
                    </div>
                @else
                    <h3>Commentaire (0)</h3>
                @endif
            </div>
        </div>

    </main>

@endsection

