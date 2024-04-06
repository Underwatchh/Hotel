@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <form action="{{route('filterHotel')}}" method="POST">
                        @csrf
                        <label for="name" class="text-black">Search by hotel name:</label>
                        <input type="text" name="name" id="name" class="text-black">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                    <a href="{{route('hotel')}}">
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
                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Location
                                </th>
                                <th>
                                    Price Range
                                </th>
                                <th>
                                    Amenities
                                </th>
                                <th>
                                    Image Path
                                </th>
                                <th colspan="2">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotels as $h)
                            <tr>
                                <td>
                                    {{$h->id}}
                                </td>
                                <td>
                                    {{$h->name}}
                                </td>
                                <td>
                                    {{$h->location}}
                                </td>
                                <td>
                                    @for ($i = 0; $i < $h->priceRange; $i++)
                                        <i class="bi bi-currency-dollar text-success"></i>
                                        @endfor
                                </td>
                                <td>
                                    {{$h->amenities}}
                                </td>
                                <td>
                                    {{$h->img}}
                                </td>
                                <td>
                                    <a href="{{route('delHotel', ['id'=>$h->id])}}">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('editHotel', ['id'=>$h->id])}}">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Button trigger modal -->

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create New Record
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-black" id="exampleModalLabel">Create a new Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Create new Hotel Form -->
                            <form method="POST" action="{{route('createHotel')}}">
                                @csrf
                                <label for="name" class='text-black'>Hotel name:</label>
                                <input type="text" class='form-control @error("name") is-invalid @enderror' name='name' id='name'>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{$message}}</span>
                                @enderror
                                <label for="location" class='text-black'>Hotel location:</label>
                                <input type="text" class='form-control @error("location") is-invalid @enderror' name='location' id='location'>
                                @error('location')
                                <span class="invalid-feedback" role="alert">{{$message}}</span>
                                @enderror
                                <label for="priceRange" class='text-black'>Price Ranges:</label>
                                <input type="number" class='form-control @error("priceRange") is-invalid @enderror' name='priceRange' id='priceRange'>
                                @error('priceRange')
                                <span class="invalid-feedback" role="alert">{{$message}}</span>
                                @enderror
                                <label for="amenities" class='text-black'>Amenities:</label>
                                <input type="text" class='form-control @error("amenities") is-invalid @enderror' name='amenities' id='amenities'>
                                @error('amenities')
                                <span class="invalid-feedback" role="alert">{{$message}}</span>
                                @enderror
                                <label for="img" class='text-black'>Image Path:</label>
                                <input type="text" class='form-control @error("img") is-invalid @enderror' name='img' id='img'>
                                @error('img')
                                <span class="invalid-feedback" role="alert">{{$message}}</span>
                                @enderror


                                <button type='submit' class='btn btn-primary mt-4'>Save</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
            @if($errors->any())
            <span class="text-danger mt-3" role="alert">
                {{ implode(' ', $errors->all(':message')) }}
            </span>
            @endif


        </div>
    </div>
</div>
@endsection