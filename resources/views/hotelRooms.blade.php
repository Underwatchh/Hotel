@extends('layouts.app')
@section('content')
<div class="card my-3">
    <div class="card-body">
        <div class="row">
            <div class="col">

                <h4>
                    <i class="bi bi-star-fill text-warning"></i>{{$rating->average_rating}} {{$hotel->name}}
                </h4>
                <br>
                <img class="h-75 w-75 img-thumbnail" src="{{ asset('images/' . $hotel->img) }}" alt="img">
            </div>
            <div class="col">

                <br>
                <ul class="list-unstyled">
                    <li>
                        Location {{$hotel->location}}
                    </li>
                    <li>
                        Price Range @for ($i = 0; $i < $hotel->priceRange; $i++) <i class="bi bi-currency-dollar text-success"></i>
                            @endfor
                    </li>
                    <li>
                        Amenities <br>{{$hotel->amenities}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5>Available Rooms</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Room type</th>
                            <th>Price Per Night</th>
                            <th>Capacity</th>
                            <th>Amenities</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $r)
                        <tr>
                            <td>
                                {{$r->type}}
                            </td>
                            <td>
                                {{$r->pricePerNight}} SAR
                            </td>
                            <td>
                                {{$r->capacity}}
                            </td>
                            <td>
                                {{$r->amenities}}
                            </td>
                            <td>
                                @if(!auth()->check())
                                <a href="{{ route('login') }}">
                                    <button type="button" class="btn btn-primary mt-3">
                                        Book
                                    </button>
                                </a>

                                @else
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-black" id="exampleModalLabel">Select Date</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Create new Rating Form -->
                                                <form method="POST" action="{{route('BookRoom')}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$r->id}}" name="roomId" id="roomId">
                                                    <input type="hidden" value="{{$hotel->id}}" name="hotelId" id="hotelId">
                                                    <label for="checkInDate" class="text-black">Check in date:</label>
                                                    <input name="checkInDate" id="checkInDate" class="form-control text-black @error('checkInDate') is-invalid @enderror" type="date">
                                                    @error('checkInDate')
                                                    <span class="invalid-feedback">{{$message}}</span>
                                                    @enderror

                                                    <label for="checkOutDate" class="text-black">Check out date:</label>
                                                    <input name="checkOutDate" id="checkOutDate" class="form-control text-black @error('checkInDate') is-invalid @enderror" type="date">
                                                    @error('checkOutDate')
                                                    <span class="invalid-feedback">{{$message}}</span>
                                                    @enderror

                                                    <button type='submit' class='btn btn-primary mt-4'>Book</button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5>
                    Ratings
                </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Rating
                            </th>
                            <th>
                                Customer
                            </th>
                            <th>
                                Comment
                            </th>
                            <th>
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Rating
                            </td>
                            <td>
                                Customer name
                            </td>
                            <td>
                                Comment
                            </td>
                            <td>
                                Date
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection