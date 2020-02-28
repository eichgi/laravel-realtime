@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <ul id="users">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.axios.get('/api/users')
            .then(res => {
                const usersElement = document.querySelector('#users');
                let users = res.data;

                users.forEach(user => {
                    let element = document.createElement('li');
                    element.innerText = user.name;
                    element.setAttribute('id', user.id);
                    usersElement.appendChild(element);
                });
            });
    </script>

    <script>
        const usersElement = document.querySelector('#users');
        Echo.channel('users')
            .listen('UserCreated', e => {
                let element = document.createElement('li');
                element.setAttribute('id', e.user.id);
                element.innerText = e.user.name;
                usersElement.appendChild(element);
            })
            .listen('UserUpdated', e => {
                let element = document.getElementById(e.user.id);
                element.innerText = e.user.name;
            })
            .listen('UserDestroyed', e => {
                let element = document.getElementById(e.user.id);
                element.parentNode.removeChild(element);
            })
    </script>
@endpush
