@extends('client.master')
@section('client')
    <main>

        <div class="container margin_detail">
            <div class="row">
                <h3>Mon Commentaire</h3>

                <div class="col-md-8 mt-4 mb-4">

                    @if ($comment)

                        <form action="{{ route('client.commandes.update_comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{ ($comment) ? $comment->id : '' }}">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form group">
                                        <textarea name="comment" class="form-control" placeholder="Laissez vos avis sur la commande">{{ $comment->comment }}</textarea>
                                        @error('comment')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form group">
                                        <button type="submit" class="btn btn-warning">Modifier</button>
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

