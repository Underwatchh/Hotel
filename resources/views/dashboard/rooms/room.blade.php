@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <form action="{{route('filterRooms')}}" method="POST">
                        @csrf
                        <label for="name" class="text-black">Search by hotel name:</label>
                        <input type="text" name="name" id="name" class="text-black">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                    <a href="{{route('rooms')}}"><button class="btn btn-primary">Show All</button></a>
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
                                <th>
                                    ID
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Price per night
                                </th>
                                <th>
                                    Capacity
                                </th>
                                <th>
                                    Amenities
                                </th>
                                <th>
                                    Hotel Name
                                </th>
                                <th colspan="2">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $r)
                            <tr>
                                <td>
                                    {{$r->id}}
                                </td>
                                <td>
                                    {{$r->type}}
                                </td>
                                <td>
                                    {{$r->pricePerNight}}
                                </td>
                                <td>
                                    {{$r->capacity}}
                                </td>
                                <td>
                                    {{$r->amenities}}
                                </td>
                                <td>
                                    {{$r->name}}
                                </td>
                                <td>
                                    <a href="{{route('delRoom', ['id'=>$r->id])}}">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('editRoom', ['id'=>$r->id])}}">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>




            <!-- Create new Room Form -->
            <h2 class="text-dark mt-3">Create a new Record</h2>
            <form method="POST" action="{{route('createRoom')}}">
                @csrf
                <label for="hotelId" class='text-black'>Hotel name:</label>
                <select class="form-select" name="hotelId" id="hotelId">
                    @foreach($hotels as $h)
                    <option class="text-dark" value="{{$h->id}}">{{$h->name}}</option>
                    @endforeach
                </select>

                <label for="type" class="text-black">Room type:</label>
                <input name="type" id="type" class="form-control text-black @error('type') is-invalid @enderror" type="text">
                @error('type')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror

                <label for="pricePerNight" class="text-black">Price per night:</label>
                <input name="pricePerNight" id="pricePerNight" class="form-control text-black @error('pricePerNight') is-invalid @enderror" type="number" step="0.01" min="1">
                @error('pricePerNight')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror

                <label for="capacity" class="text-black">Room capacity:</label>
                <input name="capacity" id="capacity" class="form-control text-black @error('capacity') is-invalid @enderror" type="number" min="1">
                @error('capacity')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror

                <label for="amenities" class="text-black">Amenities:</label>
                <input name="amenities" id="amenities" class="form-control text-black @error('amenities') is-invalid @enderror" type="text">
                @error('amenities')
                <span class="is-invalid text-danger">{{$message}}</span>
                @enderror
                <br>
                <button type='submit' class='btn btn-primary mt-4'>Save</button>
            </form>

        </div>
    </div>
</div>
@endsection