@extends('layouts.base')

@section('content')

<form method="POST" action="{{ route('updateRoom') }}">
    @csrf

    <input type="hidden" name="id" value="{{$room->id}}">

    <label for="hotelId" class='text-black'>New Hotel name(Old name: {{$room->name}}):</label>
    <select class="form-select" name="hotelId" id="hotelId">
        @foreach($hotels as $h)

        <option class="text-dark" value="{{$h->id}}">{{$h->name}}</option>
        @endforeach
    </select>

    <label for="type" class="text-black">New Room type(Old room type {{$room->type}}):</label>
    <input name="type" id="type" class="form-control text-black @error('type') is-invalid @enderror" type="text">
    @error('type')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror

    <label for="pricePerNight" class="text-black">New Price per night(Old price per night {{$room->pricePerNight}}):</label>
    <input name="pricePerNight" id="pricePerNight" class="form-control text-black @error('pricePerNight') is-invalid @enderror" type="number" step="0.01" min="1">
    @error('pricePerNight')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror

    <label for="capacity" class="text-black">New Room capacity(Old room capacity {{$room->capacity}}):</label>
    <input name="capacity" id="capacity" class="form-control text-black @error('capacity') is-invalid @enderror" type="number" min="1">
    @error('capacity')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror

    <label for="amenities" class="text-black">New Amenities(Old amenities {{$room->amenities}}):</label>
    <input name="amenities" id="amenities" class="form-control text-black @error('amenities') is-invalid @enderror" type="text">
    @error('amenities')
    <span class="is-invalid text-danger">{{$message}}</span>
    @enderror
    <br>
    <button type="submit" class="btn btn-primary mt-4">Save</button>
</form>

@endsection