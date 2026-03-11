@extends('client.master')
@section('client')
    <main>

        <div class="container margin_detail">
            <div class="row">
                <h3>Mon Commentaire</h3>

                <div class="col-md-8 mt-4 mb-4">

                    @if ($comment)
                        <ul>
                            <li>{{ $comment->comment }} <em><a href="{{ route('client.commandes.edit_comment', $comment->id) }}">[Modifier]</a></em></li>
                        </ul>
                    @else
                        <p>Vous avez 0 commentaire sur cette commande.</p>
                        <form action="{{ route('client.commandes.store_comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ ($order) ? $order->id : '' }}">
                            <input type="hidden" name="client_id" value="{{ ($order) ? $order->client->id : '' }}">
                            <input type="hidden" name="restaurant_id" value="{{ ($order) ? $order->restaurant->id : '' }}">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form group">
                                        <textarea name="comment" class="form-control" placeholder="Laissez vos avis sur la commande"></textarea>
                                        @error('comment')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form group">
                                        <button type="submit" class="btn btn-primary">Commenter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>

    </main>

@endsection

