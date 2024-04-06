<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function Hotel()
    {
        $hotels = Hotel::all();

        $averageRatings = DB::table('ratings')
            ->select('hotelId', DB::raw('AVG(rating) as average_rating'))
            ->join('reservations', 'ratings.reservationId', '=', 'reservations.id')
            ->groupBy('hotelId')
            ->get();

        $ratingMap = [];

        foreach ($averageRatings as $rating) {
            $ratingMap[$rating->hotelId] = $rating->average_rating;
        }

        return view('hotels', ['hotels' => $hotels, 'rating' => $ratingMap]);
    }
    public function Rooms($id)
    {
        $hotel = Hotel::where('id', $id)->first();

        $averageRatings = DB::table('ratings')
            ->select('hotelId', DB::raw('AVG(rating) as average_rating'))
            ->where('hotelId', $id)
            ->join('reservations', 'ratings.reservationId', '=', 'reservations.id')
            ->groupBy('hotelId')
            ->first();

        $rooms = Room::where('hotelId', $id)->get();

        return view('hotelRooms', ['hotel' => $hotel, 'rating' => $averageRatings, 'rooms' => $rooms]);
    }
    public function Book(Request $req)
    {
        $this->middleware('auth');
        $req->validate([
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date|after:check_in_date'
        ]);

        $reservation = Reservation::create([
            'checkInDate' => $req->checkInDate,
            'checkOutDate' => $req->checkOutDate,
            'paid' => 0,
            'customerId' => Auth::id(),
            'roomId' => $req->roomId,
            'hotelId' => $req->hotelId
        ]);

        $reservation->save();

        return Redirect('hotels/' . $req->hotelId);
    }
    public function Reservations()
    {
        $reservations = Reservation::where('customerId', Auth::id())->get();

        return view('reservations', ['reservations' => $reservations]);
    }
    public function CancelReservation($id)
    {
        $reservation = Reservation::where('id', $id)->first();
        $reservation->delete();

        return Redirect('/reservations');
    }
    public function PayNow(Request $req)
    {
        $invoice = Invoice::create([
            'paymentMethod' => $req->paymentMethod,
            'reservationId' => $req->reservationId
        ]);

        $reservation = Reservation::where('id', $req->reservationId)->update([
            'paid' => 1
        ]);
        return Redirect('/reservations');
    }

    public function Rate(Request $req)
    {
        $rating = Rating::create([
            'rating' => $req->rating,
            'date' => $req->date,
            'comment' => $req->comment,
            'reservationId' => $req->reservationId
        ]);
        return Redirect('/reservations');
    }

    public function Ratings()
    {
        $ratings = Rating::select(
            'ratings.rating',
            'ratings.comment',
            'ratings.date',
            'ratings.id as rId',
            'hotels.name as hotelName',
            'rooms.type as roomType'
        )
            ->join('reservations', 'ratings.reservationId', '=', 'reservations.id')
            ->where('customerId', Auth::id())
            ->join('rooms', 'reservations.roomId', '=', 'rooms.id')
            ->join('hotels', 'rooms.hotelId', '=', 'hotels.id')
            ->get();
        return view('ratings', ['ratings' => $ratings]);
    }
}
