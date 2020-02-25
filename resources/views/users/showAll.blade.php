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
@endpush
