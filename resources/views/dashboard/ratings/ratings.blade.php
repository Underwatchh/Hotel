@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <form action="{{route('filterRatings')}}" method="POST">
                        @csrf
                        <label for="rating" class="text-black">Search by rating:</label>
                        <input type="number" step="0.1" name="rating" id="rating" class="text-black">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                    <a href="{{route('rating')}}"><button class="btn btn-primary">Show All</button></a>
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
                                    Rating
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Comment
                                </th>
                                <th>
                                    Reservation ID
                                </th>
                                <th colspan="2">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ratings as $r)
                            <tr>
                                <td>
                                    {{$r->id}}
                                </td>
                                <td>
                                    {{$r->rating}}
                                </td>
                                <td>
                                    {{$r->date}}
                                </td>
                                <td>
                                    {{$r->comment}}
                                </td>
                                <td>
                                    {{$r->reservationId}}
                                </td>
                                <td>
                                    <a href="{{route('delRating', ['id'=>$r->id])}}">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('editRating', ['id'=>$r->id])}}">
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
                            <!-- Create new Rating Form -->
                            <form method="POST" action="{{route('createRating')}}">
                                @csrf
                                <label for="reservationId" class='text-black'>Reservation:</label>
                                <select class="form-select" name="reservationId" id="reservationId">
                                    @foreach($reservations as $r)
                                    <option class="text-dark" value="{{$r->id}}">{{$r->id}}. {{$r->hName}}, {{$r->uName}} | from
                                        {{$r->checkInDate}}
                                        to {{$r->checkOutDate}}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="rating" class="text-black">Rating:</label>
                                <input name="rating" id="rating" class="form-control text-black @error('rating') is-invalid @enderror" type="number" step="0.1">
                                @error('rating')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror

                                <label for="date" class="text-black">Date:</label>
                                <input name="date" id="date" class="form-control text-black @error('date') is-invalid @enderror" type="date">
                                @error('date')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror

                                <label for="comment" class="text-black">Comment:</label>
                                <input name="comment" id="comment" class="form-control text-black @error('comment') is-invalid @enderror" type="text">
                                @error('comment')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                                <br>
                                <button type='submit' class='btn btn-primary mt-4'>Save</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>

            <span class="text-danger mt-3" role="alert">
                {{ implode(' ', $errors->all(':message')) }}
            </span>
        </div>
    </div>
</div>
@endsection