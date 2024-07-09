<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMailController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\AuthDashboardController;
use App\model\Admin;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ParagraphController;
use App\Http\Controllers\ImageController;
//use App\Mail\SendContactMail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/upload/menu20', [UploadController::class, 'uploadMenu20']);
Route::post('/upload/menugrupo', [UploadController::class, 'uploadMenuGrupo']);
Route::post('/upload/menuinfantil', [UploadController::class, 'uploadMenuInfantil']);
Route::post('/upload/raciones', [UploadController::class, 'uploadRaciones']);
Route::post('/upload/tapas', [UploadController::class, 'uploadTapas']);
Route::post('/upload/postres', [UploadController::class, 'uploadPostres']);
Route::post('/contact', [ContactMailController::class, 'send']);
Route::post('/login-dashboard', [AuthDashboardController::class, 'authenticate']);
Route::post('/parrafos/{id}/imagen', [ParagraphController::class, 'updateImage']);
Route::post('/update-image', [ImageController::class, 'update']);
Route::post('/reservations/{id}/cancelByClient', [ReservationController::class, 'cancelByClient']);
Route::post('/reservations', [ReservationController::class, 'store']);

Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);
Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancel']);
Route::put('/reservations/{id}/accept', [ReservationController::class, 'accept']);
Route::put('/reservations/{id}/score', [ReservationController::class, 'updateScore']);
Route::put('/reservations/{id}/score', [ReservationController::class, 'updateScore']);
Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancel']);
Route::put('/reservations/{id}/accept', [ReservationController::class, 'accept']);

Route::put('/parrafos/{id}', [ParagraphController::class, 'update']);

Route::get('/reservations/search-by-date', [ReservationController::class, 'searchByDate']);
Route::get('/get-image', [ImageController::class, 'get']);
Route::get('/reservations/{id}', [ReservationController::class, 'show']);
Route::get('/parrafos', [ParagraphController::class, 'index']);
Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/reservations/aceptadas', [ReservationController::class, 'getAceptadas']);
Route::get('/reservations/rechazadas', [ReservationController::class, 'getRechazadas']);
Route::get('/reservations', [ReservationController::class, 'getReservations']);
Route::get('/checkScore/{phone}/{email}', [ReservationController::class, 'checkScore']);
Route::get('/storage/{filename}', [ImageController::class, 'serveImage']);
// Route::get('/reservations/aceptadas', [ReservationController::class, 'getAceptadas']);
// Route::get('/reservations/rechazadas', [ReservationController::class, 'getRechazadas']);
// Route::get('/reservations', [ReservationController::class, 'getReservations']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
   

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});
