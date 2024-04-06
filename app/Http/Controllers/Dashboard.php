<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\Invoice;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isEmpty;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
        return view('dashboard.index');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return Redirect('/login');
    }

    //---------------------<Hotel Controller>-----------------------
    public function Hotel(Request $request)
    {
        if ($request->filled('name')) {
            $hotels = Hotel::where('name', $request->name)->get();
        } else {
            $hotels = Hotel::all();
        }

        return view('dashboard.hotels.hotel', ['hotels' => $hotels]);
    }
    public function CreateHotel(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'location' => 'required',
            'priceRange' => 'required|numeric|min:1|max:5',
            'amenities' => 'required',
            'img' => 'required'
        ]);
        $hotel = Hotel::create([
            'name' => $req->name,
            'location' => $req->location,
            'priceRange' => $req->priceRange,
            'amenities' => $req->amenities,
            'img' => $req->img
        ]);
        $hotel->save();
        return Redirect('/dashboard/hotels');
    }
    public function DelHotel($id)
    {
        $hotel = Hotel::find($id);
        $hotel->delete();

        return Redirect('/dashboard/hotels');
    }
    public function EditHotel($id)
    {
        $h = Hotel::find($id);
        return view('/dashboard/hotels/editHotel', ['hotel' => $h]);
    }
    public function UpdateHotel(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'priceRange' => 'required|numeric|min:1|max:5',
            'amenities' => 'required'
        ]);
        $h = Hotel::where('id', $request->id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'priceRange' => $request->priceRange,
            'amenities' => $request->amenities
        ]);
        return Redirect('/dashboard/hotels');
    }
    public function SearchHotel(Request $request)
    {
        if ($request->name == null)
            return Redirect('/dashboard/hotels');
        $h = Hotel::where('name', $request->name)->get();
        return view('dashboard.hotels.hotel', ['hotels' => $h]);
    }
    //---------------------<Room Controller>-----------------------
    public function Room()
    {
        $r = Room::join('hotels', 'rooms.hotelId', '=', 'hotels.id')
            ->select('rooms.*', 'hotels.id as hotelId', 'hotels.name')
            ->get();
        $h = Hotel::all();

        return view('dashboard.rooms.room', ['rooms' => $r, 'hotels' => $h]);
    }
    public function SearchRoom(Request $req)
    {
        if ($req->name == null)
            return Redirect('/dashboard/rooms');
        $r = Room::join('hotels', 'rooms.hotelId', '=', 'hotels.id')
            ->where('hotels.name', $req->name)
            ->select('rooms.*', 'hotels.id as hotelId', 'hotels.name')
            ->get();
        $h = hotel::all();

        return view('dashboard.rooms.room', ['rooms' => $r, 'hotels' => $h]);
    }
    public function CreateRoom(Request $req)
    {
        $req->validate([
            'type' => 'required',
            'pricePerNight' => 'required|numeric|min:1',
            'capacity' => 'required|numeric|min:1',
            'amenities' => 'required',
            'hotelId' => 'required'
        ]);

        $r = Room::create([

            'type' => $req->type,
            'pricePerNight' => $req->pricePerNight,
            'capacity' => $req->capacity,
            'amenities' => $req->amenities,
            'hotelId' => $req->hotelId
        ]);

        $r->save();


        return Redirect('/dashboard/rooms');
    }
    public function DelRoom($id)
    {
        $r = Room::find($id);
        $r->delete();

        return Redirect('/dashboard/rooms');
    }

    public function EditRoom($id)
    {
        $h = Hotel::all();
        $r = Room::join('hotels', 'rooms.hotelId', '=', 'hotels.id')
            ->where('rooms.id', $id)
            ->select('rooms.*', 'hotels.name',)
            ->first();
        return view('/dashboard/rooms/editRoom', ['room' => $r, 'hotels' => $h]);
    }

    public function UpdateRoom(Request $req)
    {
        $req->validate([
            'type' => 'required',
            'pricePerNight' => 'required|numeric|min:1',
            'capacity' => 'required|numeric|min:1',
            'amenities' => 'required',
            'hotelId' => 'required'
        ]);
        $r = Room::where('id', $req->id)->update([
            'type' => $req->type,
            'pricePerNight' => $req->pricePerNight,
            'capacity' => $req->capacity,
            'amenities' => $req->amenities,
            'hotelId' => $req->hotelId
        ]);
        return Redirect('/dashboard/rooms');
    }

    //---------------------<Rating Controller>-----------------------

    public function Rating()
    {
        $r = Rating::all();

        $reservations = Reservation::join('hotels', 'reservations.hotelId', '=', 'hotels.id')
            ->join('users', 'reservations.customerId', '=', 'users.id')
            ->select('reservations.*', 'hotels.name as hName', 'users.name as uName')
            ->get();

        return view('dashboard/ratings/ratings', ['ratings' => $r, 'reservations' => $reservations]);
    }

    public function CreateRating(Request $req)
    {
        $req->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'date' => 'required|date',
            'comment' => 'required'
        ]);

        $rating = Rating::create([
            'reservationId' => $req->reservationId,
            'rating' => $req->rating,
            'date' => $req->date,
            'comment' => $req->comment
        ]);
        $rating->save();

        return Redirect('dashboard/ratings');
    }
    public function SearchRating(Request $req)
    {
        if ($req->rating == null)
            return Redirect('/dashboard/ratings');
        $r = Rating::where('rating', $req->rating)->get();

        $reservations = Reservation::join('hotels', 'reservations.hotelId', '=', 'hotels.id')
            ->join('users', 'reservations.customerId', '=', 'users.id')
            ->select('reservations.*', 'hotels.name as hName', 'users.name as uName')
            ->get();

        return view('dashboard/ratings/ratings', ['ratings' => $r, 'reservations' => $reservations]);
    }
    public function DelRating($id)
    {
        $r = Rating::find($id);
        $r->delete();

        return Redirect('/dashboard/ratings');
    }
    public function EditRating($id)
    {
        $r = Rating::find($id);

        $reservations = Reservation::join('hotels', 'reservations.hotelId', '=', 'hotels.id')
            ->join('users', 'reservations.customerId', '=', 'users.id')
            ->select('reservations.*', 'hotels.name as hName', 'users.name as uName')
            ->get();

        return view('dashboard/ratings/editRating', ['ratings' => $r, 'reservations' => $reservations]);
    }
    public function UpdateRating(Request $req)
    {
        $req->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'date' => 'required|date',
            'comment' => 'required'
        ]);
        $rating = Rating::where('id', $req->id)->update([
            'reservationId' => $req->reservationId,
            'rating' => $req->rating,
            'date' => $req->date,
            'comment' => $req->comment
        ]);

        return Redirect('dashboard/ratings');
    }

    //---------------------<User Controller>-----------------------

    public function user(Request $req)
    {
        $users = User::all();
        return view('dashboard.users.users', ['users' => $users]);
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        return redirect()->route('dashboard.users.users')->with('success', 'User created successfully');
    }
    public function delUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('dashboard.users.users')->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('dashboard.users.users')->with('success', 'User deleted successfully');
    }

    public function editUser($id)
    {

        $user = User::findOrFail($id);


        return view('dashboard.users.users', ['user' => $user]);
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string',

        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('dashboard.users.users')->with('error', 'User not found');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();


        return redirect()->route('dashboard.users.users')->with('success', 'User updated successfully');
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.users', ['user' => $user]);
    }

    public function filterUser(Request $request)
    {
        $name = $request->input('name');
        $users = User::where('name', 'like', "%$name%")->get();
        return view('dashboard.users.users', ['users' => $users]);
    }

    public function showAllUsers()
    {
        $users = User::all();
        return view('dashboard.users.users', ['users' => $users]);
    }

    public function getDashboard()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }
    //---------------------<Reservation Controller>-----------------------

    public function reservation(Request $req)
    {
        $reservations = Reservation::all();
        $customers = User::all();
        $hotels = Hotel::all();
        $rooms = Room::all();

        return view('dashboard.reservation.reservation', ['reservations' => $reservations, 'customers' => $customers, 'hotels' => $hotels, 'rooms' => $rooms]);
    }

    public function CreateReservation(Request $req)
    {
        $req->validate([
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date',
            'paid' => 'required',
            'rated' => 'required',
            'roomId' => 'required',
            'hotelId' => 'required',
            'customerId' => 'required'
        ]);
        $reservation = Reservation::create([
            'checkInDate' => $req->checkInDate,
            'checkOutDate' => $req->checkOutDate,
            'paid' => $req->paid,
            'rated' => $req->rated,
            'roomId' => $req->roomId,
            'hotelId' => $req->hotelId,
            'customerId' => $req->customerId
        ]);
        return Redirect('dashboard/reservation');
    }

    public function delReservation($id)
    {
        $reservation = Reservation::find($id);

        $reservation->delete();
        return Redirect('dashboard/reservations');
    }

    public function showEditReservationForm($id)
    {
        $reservation = Reservation::where('id', $id)->first();
        $customers = User::all();
        $hotels = Hotel::all();
        $rooms = Room::all();
        return view('dashboard.reservation.editReservation', ['reservation' => $reservation, 'customers' => $customers, 'hotels' => $hotels, 'rooms' => $rooms]);
    }

    public function updateReservation(Request $req)
    {
        $req->validate([
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date',
            'paid' => 'required',
            'rated' => 'required',
            'roomId' => 'required',
            'hotelId' => 'required',
            'customerId' => 'required'
        ]);

        $reservation = Reservation::where('id', $req->id)->update([
            'checkInDate' => $req->checkInDate,
            'checkOutDate' => $req->checkOutDate,
            'paid' => $req->paid,
            'rated' => $req->rated,
            'roomId' => $req->roomId,
            'hotelId' => $req->hotelId,
            'customerId' => $req->customerId,
        ]);

        return Redirect('dashboard/reservation');
    }
    //Invoice Controllers
    public function invoice(Request $req)
    {
        $Invoices = Invoice::all();
        return view('dashboard/Invoice/Invoice', ['Invoices' => $Invoices]);
    }


    public function createInvoice(Request $req)
    {
        Invoice::create([
            'paymentMethod' => $req->paymentMethod,
            'reservationId' => $req->reservationId
        ]);

        return redirect('/invoice');
    }
}
