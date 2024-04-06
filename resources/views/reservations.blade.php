@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-body">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>
                        Check In Date
                    </th>
                    <th>
                        Check Out Date
                    </th>
                    <th>
                        Hotel Name
                    </th>
                    <th>
                        Room
                    </th>
                    <th colspan="4S">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $r)
                <tr>
                    <td>
                        {{$r->checkInDate}}
                    </td>
                    <td>
                        {{$r->checkOutDate}}
                    </td>
                    <td>
                        {{$r->hotelId}}
                    </td>
                    <td>
                        {{$r->roomId}}
                    </td>

                    @if(!$r->paid)
                    <td colspan="2">
                        <button class="btn btn-danger form-control">Unpaid</button>
                    </td>
                    <td>
                        <a href="{{route('userCancelReservation', ['id'=>$r->id])}}">
                            <button class="btn">Cancel</button>
                        </a>
                    </td>
                    <td>
                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Pay Now
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-black" id="exampleModalLabel">Choose Payment Method
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Payment Form -->
                                        <form action="{{route('payNow')}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$r->id}}" name="reservationId" id="reservationId">
                                            <select class="form-control" name="paymentMethod" id="paymentMethod">
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="PayPal">PayPal</option>
                                            </select>
                                            <button class="btn btn-primary mt-3" type="submit">
                                                Pay
                                            </button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </td>
                    @else


                    @if(!$r->rated)
                    <td colspan="2">
                        <button class="btn btn-success form-control">Paid</button>
                    </td>
                    <td colspan="2">


                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-black" id="exampleModalLabel">Choose Payment Method
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Payment Form -->
                                        <form action="{{route('rate')}}" method="POST">
                                            @csrf
                                            <input type="hidden" id="date" name="date" value="{{ date('Y-m-d') }}">
                                            <input type="hidden" id="reservationId" name="reservationId" value="{{ $r->id }}">
                                            <label for="rating">Rating</label>
                                            <input class="form-control " type="number" step="0.1" name="rating" id="rating">
                                            <label for="comment">Comment</label>
                                            <input class="form-control" type="text" name="comment" id="comment">
                                            <button type="submit" class="btn btn-primary mt-3">
                                                Submit
                                            </button>

                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </td>
                    @else
                    <td colspan="4">
                        <button class="btn btn-success form-control">Paid</button>
                    </td>
                    @endif
                    @endif

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


@endsection