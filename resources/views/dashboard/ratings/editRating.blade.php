@extends('layouts.base')
@section('content')
<form method="POST" action="{{route('updateRating')}}">
    @csrf
    <input type="hidden" value="{{$ratings->id}}" name="id" id="id">
    <label for="reservationId" class='text-black'>New reservation(Old reservation ID {{$ratings->reservationId}}):</label>
    <select class="form-select" name="reservationId" id="reservationId">
        @foreach($reservations as $r)
        <option class="text-dark" value="{{$r->id}}">{{$r->id}}. {{$r->hName}}, {{$r->uName}} | from
            {{$r->checkInDate}}
            to {{$r->checkOutDate}}
        </option>
        @endforeach
    </select>

    <label for="rating" class="text-black">New rating(Old rating {{$ratings->rating}}):</label>
    <input name="rating" id="rating" class="form-control text-black @error('rating') is-invalid @enderror" type="number" step="0.1">
    @error('rating')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror

    <label for="date" class="text-black">New date(Old date {{$ratings->date}}):</label>
    <input name="date" id="date" class="form-control text-black @error('date') is-invalid @enderror" type="date">
    @error('date')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror

    <label for="comment" class="text-black">New Comment(Old comment {{$ratings->comment}}):</label>
    <input name="comment" id="comment" class="form-control text-black @error('comment') is-invalid @enderror" type="text">
    @error('comment')
    <span class="invalid-feedback">{{$message}}</span>
    @enderror
    <br>
    <button type='submit' class='btn btn-primary mt-4'>Save</button>
</form>
<br>
<span class="text-danger" role="alert">
    {{ implode(' ', $errors->all(':message')) }}
</span>
@endif
@endsection