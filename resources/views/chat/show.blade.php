@extends('layouts.app')
@push('styles')
    <style>

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 border rounded-lg p-3">
                                        <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">
                                            <li>Hiho</li>
                                            <li>Bye</li>
                                        </ul>
                                    </div>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input id="message" type="text" class="form-control" placeholder="Escribe tu mensaje">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary btn-block">Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                                <p><strong>Online Now!</strong></p>
                                <ul id="users" class="list-unstyled overflow-auto text-info"
                                    style="height: 45vh;"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const usersElement = document.getElementById('users');

        Echo.join('chat')
            .here(users => {
                users.forEach(user => {
                    let element = document.createElement('li');
                    element.innerText = user.name;
                    element.setAttribute('id', user.id);
                    usersElement.appendChild(element);
                });
            })
            .joining(user => {
                let element = document.createElement('li');
                element.innerText = user.name;
                element.setAttribute('id', user.id);
                usersElement.appendChild(element);
            })
            .leaving(user => {
                let element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
            });
    </script>
@endpush