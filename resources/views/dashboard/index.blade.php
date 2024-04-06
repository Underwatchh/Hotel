@extends('layouts.base')

@section('content')

<div class="container text-black">
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{route('hotel')}}" class="text-reset">
                        <h1><i class="fas fa-hotel text-black"></i></h1>
                        <span class='text-black'>Hotels</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{route('rooms')}}" class="text-reset">
                        <h1><i class="fa-solid fa-bed text-black"></i></h1>
                        <span class='text-black'>Rooms</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container text-black">
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{route('reservation')}}" class="text-reset">
                        <h1><i class="bi bi-book text-black"></i></h1>
                        <span class='text-black'>Reservation</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{route('user')}}" class="text-reset">
                        <h1><i class="bi bi-people-fill text-black"></i></h1>
                        <span class='text-black'>Users</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container text-black">
    <div class="row mt-5">
        <div class="col">
            <div class="card ">
                <div class="card-body text-center">
                    <a href="{{route('rating')}}" class="text-reset">
                        <h1><i class="bi bi-star-half text-black"></i></h1>
                        <span class='text-black'>Rating</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card ">
                <div class="card-body text-center">
                    <a href="{{route('invoice')}}" class="text-reset">
                        <h1><i class="bi bi-receipt text-black"></i></h1>
                        <span class='text-black'>Invoice</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection