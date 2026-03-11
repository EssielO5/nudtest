
<div>
    <div class="container-fluid">
        <section class="message-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="chat-area">
                            <!-- chatbox -->
                            <div class="chatbox">
                                <div class="modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="msg-head">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="d-flex align-items-center">
                                                        <span class="chat-icon"><img class="img-fluid" src="{{ asset('images/restaurants/'.$restaurant->image) }}" alt="image title"></span>
                                                        <div class="flex-shrink-0">
                                                            <img class="img-fluid" src="{{ asset('images/restaurants/'.$restaurant->image) }}" alt="user img" style="width: 50px; height:50px; border-radius:50px;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h3>{{ $restaurant->name }}</h3>
                                                            <p>Restaurant</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <ul class="moreoption">
                                                        <li class="navbar nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="{{ route('client.chat.dashboard') }}">Retour</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <div class="msg-body">
                                                <ul>
                                                    @foreach ($messages as $message)
                                                        @if (!$message['sender_client'])
                                                            <li class="sender">
                                                                <p> {{ $message['message'] }} </p>
                                                            </li>
                                                        @else
                                                            <li class="repaly">
                                                                <p> {{ $message['message'] }} </p>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="send-box">
                                            <form wire:submit.prevent="sendMessage()">
                                                <input type="text" wire:model="message" name="message" class="form-control" aria-label="message…" placeholder="Ecrire un message…">

                                                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Envoyer</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chatbox -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

