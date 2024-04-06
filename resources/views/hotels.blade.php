@extends('layouts.app')
@section('content')

@foreach($hotels as $hotel)
<div class="card my-3">

    <div class="card-body">
        <div class="row">
            <div class="col">

                <h4>
                    <i class="bi bi-star-fill text-warning"></i>{{$rating[$hotel->id]}} {{$hotel->name}}
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
            <div class="col">
                <a href="{{route('userRooms', ['id'=>$hotel->id])}}">
                    <button class="btn btn-secondary  mt-5">
                        Rooms
                    </button>
                </a>
            </div>
        </div>
    </div>

</div>
@endforeach

@endsection