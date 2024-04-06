<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('userHome');

// ----------------------------<dashboard>-----------------------------

Route::get(
    '/dashboard',
    [Dashboard::class, 'Index']
)->name('dashboard');

// ----------------------------<Hotels>-----------------------------

Route::get(
    '/dashboard/hotels',
    [Dashboard::class, 'Hotel']
)->name('hotel');
Route::post(
    '/dashboard/hotels/createHotel',
    [Dashboard::class, 'CreateHotel']
)->name('createHotel');

Route::get(
    '/dashboard/hotels/delete/{id}',
    [Dashboard::class, 'DelHotel']
)->name('delHotel');

Route::get(
    'dashboard/hotels/edit/{id}',
    [Dashboard::class, 'EditHotel']
)->name('editHotel');

Route::post(
    'dashboard/hotels/update',
    [Dashboard::class, 'UpdateHotel']
)->name('updateHotel');

Route::post(
    'dashboard/hotels/filter',
    [Dashboard::class, 'Hotel']
)->name('filterHotel');

// ----------------------------<Rooms>-----------------------------

Route::get(
    '/dashboard/rooms',
    [Dashboard::class, 'Room']
)->name('rooms');

Route::post(
    '/dashboard/rooms/filter',
    [Dashboard::class, 'SearchRoom']
)->name('filterRooms');

Route::post(
    '/dashboard/rooms/createRoom',
    [Dashboard::class, 'CreateRoom']
)->name('createRoom');

Route::get(
    'dashboard/rooms/deleteRoom/{id}',
    [Dashboard::class, 'DelRoom']
)->name('delRoom');

Route::get(
    'dashboard/rooms/editRoom/{id}',
    [Dashboard::class, 'EditRoom']
)->name('editRoom');

Route::post(
    'dashboard/rooms/update',
    [Dashboard::class, 'UpdateRoom']
)->name('updateRoom');

Route::get(
    'dashboard/ratings',
    [Dashboard::class, 'Rating']
)->name('rating');

Route::post(
    'dashboard/ratings/createRating',
    [Dashboard::class, 'CreateRating']
)->name('createRating');

Route::post(
    'dashboard/ratings/filter',
    [Dashboard::class, 'SearchRating']
)->name('filterRatings');

Route::get(
    'dashboard/ratings/deleteRating/{id}',
    [Dashboard::class, 'DelRating']
)->name('delRating');


Route::get(
    'dashboard/ratings/edit/{id}',
    [Dashboard::class, 'EditRating']
)->name('editRating');

Route::post(
    'dashboard/ratings/update',
    [Dashboard::class, 'UpdateRating']
)->name('updateRating');



// ----------------------------<User>-----------------------------

Route::get(
    '/user',
    [Dashboard::class, 'user']
)->name('user');


Route::post(
    '/users/create',
    [dashboard::class, 'createUser']
)->name('createUser');

Route::get(
    '/users/{id}/delete',
    [dashboard::class, 'deleteUser']
)->name('deleteUser');

Route::get(
    '/users/{id}/edit',
    [dashboard::class, 'showEditUserForm']
)->name('showEditUserForm');

Route::get(
    '/dashboard/users',
    [Dashboard::class, 'user']
)->name('dashboard.users.users');

Route::post(
    '/users/{id}/update',
    [dashboard::class, 'updateUser']
)->name('updateUser');

Route::get(
    '/users/{id}/edit',
    [dashboard::class, 'edit']
)->name('editUser');

Route::get(
    '/users/{id}',
    [dashboard::class, 'viewUser']
)->name('viewUser');

Route::get(
    '/delUser/{id}',
    [dashboard::class, 'delUser']
)->name('delUser');

Route::get(
    '/editUser/{id}',
    [dashboard::class, 'editUser']
)->name('editUser');

Route::post(
    '/filterUser',
    [dashboard::class, 'filterUser']
)->name('filterUser');

Route::get(
    '/show-all-users',
    [dashboard::class, 'showAllUsers']
)->name('showAllUsers');

// ----------------------------<Reservation>-----------------------------

Route::get(
    '/dashboard/reservation',
    [Dashboard::class, 'reservation']
)->name('reservation');

Route::get(
    '/dashboard/reservations/{id}',
    [Dashboard::class, 'viewReservation']
)->name('viewReservation');

Route::get(
    '/dashboard/reservations',
    [Dashboard::class, 'reservation']
)->name('dashboard.reservations.reservations');

Route::post(
    '/dashboard/reservations/create',
    [Dashboard::class, 'CreateReservation']
)->name('createReservation');

Route::get(
    '/dashboard/reservations/delete/{id}',
    [Dashboard::class, 'delReservation']
)->name('delReservation');

Route::get(
    '/dashboard/reservation/edit/{id}',
    [Dashboard::class, 'showEditReservationForm']
)->name('editReservation');

Route::post(
    '/dashboard/reservations/update',
    [Dashboard::class, 'updateReservation']
)->name('updateReservation');
// ----------------------------<invoice>-----------------------------
Route::get(
    '/dashboard/invoice',
    [Dashboard::class, 'invoice']
)->name('invoice');

Route::post(
    '/dashboard/invoices/create',
    [Dashboard::class, 'createInvoice']
)->name('createInvoice');


Route::get(
    '/logout',
    [Dashboard::class, 'Logout']
)->name('logout');

//User Pages Route
Route::get(
    '/hotels',
    [HotelController::class, 'Hotel']
)->name('userHotels');

Route::get(
    '/hotels/{id}',
    [HotelController::class, 'Rooms']
)->name('userRooms');

Route::post(
    'hotels/book',
    [HotelController::class, 'Book']
)->name('BookRoom');

Route::get(
    'reservations',
    [HotelController::class, 'Reservations']
)->name('userReservations');

Route::get(
    'reservations/cancel/{id}',
    [HotelController::class, 'CancelReservation']
)->name('userCancelReservation');

Route::post(
    'reservations/pay',
    [HotelController::class, 'PayNow']
)->name('payNow');

Route::post(
    'reservations/rate',
    [HotelController::class, 'Rate']
)->name('rate');

Route::get(
    'ratings',
    [HotelController::class, 'Ratings']
)->name('userRatings');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
