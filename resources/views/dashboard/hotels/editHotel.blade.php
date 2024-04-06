@extends('layouts.base')

@section('content')

<form method="POST" action="{{ route('updateHotel') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $hotel->id }}">
    <label for="name" class="text-black">New Hotel name(Old name: {{$hotel->name}}):</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
    @error('name')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror
    <label for="location" class="text-black">New Hotel location(Old location: {{$hotel->location}}):</label>
    <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" id="location">
    @error('location')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror
    <label for="priceRange" class="text-black">New Price Range(Old price range: {{$hotel->priceRange}})s:</label>
    <input type="number" class="form-control @error('priceRange') is-invalid @enderror" name="priceRange" id="priceRange">
    @error('priceRange')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror

    <label for="amenities" class="text-black">New Amenities(Old amenities: {{$hotel->amenities}}):</label>
    <input type="text" class="form-control @error('amenities') is-invalid @enderror" name="amenities" id="amenities">
    @error('amenities')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror
    <button type="submit" class="btn btn-primary mt-4">Save</button>
</form>

@endsection