@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                        <form action="{{ route('filterUser') }}" method="POST">
                        @csrf
                        <label for="name" class="text-black">Search by user name:</label>
                        <input type="text" name="name" id="name" class="text-black">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>

                    <a href="{{ route('showAllUsers') }}">
                        <button class="btn btn-primary">Show All</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>
                                <a href="{{ route('delUser', ['id' => $user->id]) }}">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('editUser', ['id' => $user->id]) }}">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Create new User Form -->
    <div class="row">
        <div class="col">
            <h2 class="text-dark mt-3">Create a new User</h2>
            <form method="POST" action="{{route('createUser')}}">
                @csrf
                <label for="name" class="text-black">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                @error('name')
                <span class="invalid-feedback" role="alert">{{$message}}</span>
                @enderror
                <label for="email" class="text-black">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                @error('email')
                <span class="invalid-feedback" role="alert">{{$message}}</span>
                @enderror
                <label for="phone" class="text-black">Phone:</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone">
                @error('phone')
                <span class="invalid-feedback" role="alert">{{$message}}</span>
                @enderror
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
