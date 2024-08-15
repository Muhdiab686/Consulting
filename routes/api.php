<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\CustumarController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ConsultingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("/registeruser", [CustumarController::class, "registeruser"]);
Route::post("/registermanjer", [CustumarController::class, "registermanjer"]);
Route::post("/login", [CustumarController::class, "login"]);
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::group(["middleware" => ["checkManager"]], function(){
        Route::post("/create", [ConsultingController::class, "createConsulting"]);
        Route::get("/getappion", [AppointmentController::class, "getAppointments"]);
    });
    Route::group(["middleware" => ["checkUser"]], function(){
        Route::post("/appointment", [AppointmentController::class, "bookAnAppointment"]);
    });
    Route::get("/profile", [CustumarController::class, "profile"]);
    Route::delete("/logout", [CustumarController::class, "logout"]);
    Route::get("/browser/{id}", [ConsultingController::class, "browseconsulting"]);
    Route::get("search/{name}", [ConsultingController::class, "search"]);
    Route::get("show", [ConsultingController::class, "showTypeconsulting"]);

});
