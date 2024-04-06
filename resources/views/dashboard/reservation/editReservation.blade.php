@extends('layouts.base')
@section('content')

<form method="POST" action="{{route('updateReservation')}}">
    @csrf
    <input type="hidden" value="{{$reservation->id}}" name="id" id="id">
    <label for="customerId" class="text-black">Customer(Old Customer ID {{$reservation->id}}):</label>
    <select class="form-control" name="customerId" id="customerId">
        @foreach($customers as $customer)
        <option class="text-black" value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>
    <label for="hotelId" class="text-black">Hotel(Old Hotel ID {{$reservation->hotelId}}):</label>
    <select class="form-control" name="hotelId" id="hotelId">
        @foreach($hotels as $hotel)
        <option class="text-black" value="{{ $hotel->id }}">{{ $hotel->name }}</option>
        @endforeach
    </select>
    <label for="roomId" class="text-black">Room ID(Old Room ID {{$reservation->roomId}}):</label>
    <select class="form-control" name="roomId" id="roomId">
        @foreach($rooms as $room)
        <option class="text-black" value="{{ $room->id }}">Hotel ID {{$room->hotelId}}, Room ID {{ $room->id }}</option>
        @endforeach
    </select>

    <label for="checkInDate" class="text-black">Check-in Date(Old Check In Date {{$reservation->checkInDate}}):</label>
    <input type="date" class="form-control" name="checkInDate" id="checkInDate">
    <label for="checkOutDate" class="text-black">Check-out Date(Old Check Out Date {{$reservation->checkOutDate}}):</label>
    <input type="date" class="form-control" name="checkOutDate" id="checkOutDate">
    <label for="paid" class="text-black">Paid(Old Paid status {{$reservation->paid}})</label>
    <select name="paid" id="paid" class="form-control">
        <option class="text-black" value="1">Yes</option>
        <option class="text-black" value="0">No</option>
    </select>
    <label for="rated" class="text-black">Rated(Old Rated statues {{$reservation->rated}})</label>
    <select name="rated" id="rated" class="form-control">
        <option class="text-black" value="1">Yes</option>
        <option class="text-black" value="0">No</option>
    </select>
    <button type="submit" class="btn btn-primary mt-4">Save</button>
</form>

@endsection