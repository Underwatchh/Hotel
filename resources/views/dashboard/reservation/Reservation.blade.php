@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <!-- Reservations Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Customer ID</th>
                                <th>Hotel ID</th>
                                <th>Room ID</th>
                                <th>Paid</th>
                                <th>Rated</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{$reservation->id}}</td>
                                <td>{{$reservation->checkInDate}}</td>
                                <td>{{$reservation->checkOutDate}}</td>
                                <td>{{$reservation->customerId}}</td>
                                <td>{{$reservation->hotelId}}</td>
                                <td>{{$reservation->roomId}}</td>
                                <td>
                                    @if($reservation->paid) Yes @else No @endif
                                </td>
                                <td>
                                    @if($reservation->rated) Yes @else No @endif
                                </td>
                                <td>
                                    <a href="{{route('delReservation', ['id'=>$reservation->id])}}">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('editReservation', ['id'=>$reservation->id])}}">
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

    <!-- Create new Reservation Form -->
    <div class="row">
        <div class="col">
            <h2 class="text-dark mt-3">Create a new Reservation</h2>
            <form method="POST" action="{{route('createReservation')}}">
                @csrf
                <label for="customerId" class="text-black">Customer:</label>
                <select class="form-control" name="customerId" id="customerId">
                    @foreach($customers as $customer)
                    <option class="text-black" value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                <label for="hotelId" class="text-black">Hotel:</label>
                <select class="form-control" name="hotelId" id="hotelId">
                    @foreach($hotels as $hotel)
                    <option class="text-black" value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                </select>
                <label for="roomId" class="text-black">Room ID:</label>
                <select class="form-control" name="roomId" id="roomId">
                    @foreach($rooms as $room)
                    <option class="text-black" value="{{ $room->id }}">Hotel ID {{$room->hotelId}}, Room ID {{ $room->id }}</option>
                    @endforeach
                </select>

                <label for="checkInDate" class="text-black">Check-in Date:</label>
                <input type="date" class="form-control" name="checkInDate" id="checkInDate">
                <label for="checkOutDate" class="text-black">Check-out Date:</label>
                <input type="date" class="form-control" name="checkOutDate" id="checkOutDate">
                <label for="paid" class="text-black">Paid</label>
                <select name="paid" id="paid" class="form-control">
                    <option class="text-black" value="1">Yes</option>
                    <option class="text-black" value="0">No</option>
                </select>
                <label for="rated" class="text-black">Rated</label>
                <select name="rated" id="rated" class="form-control">
                    <option class="text-black" value="1">Yes</option>
                    <option class="text-black" value="0">No</option>
                </select>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection