@extends('layouts.app')
@section('content')

<table class="table">

    <thead>
        <tr>
            <th>
                Rating ID
            </th>
            <th>
                Rating
            </th>
            <th>
                Comment
            </th>
            <th>
                Date
            </th>
            <th>
                Hotel Name
            </th>
            <th>
                Room Type
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($ratings as $r)
        <tr>
            <td>
                {{$r->rId}}
            </td>
            <td>
                {{$r->rating}}
            </td>
            <td>
                {{$r->comment}}
            </td>
            <td>
                {{$r->date}}
            </td>
            <td>
                {{$r->hotelName}}
            </td>
            <td>
                {{$r->roomType}}
            </td>
        </tr>
        @endforeach
    </tbody>


</table>

@endsection