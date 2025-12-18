<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource("/registrations",RegistrationController::class)
    ->whereNumber('registration')
;
Route::get('/registrations/count',[RegistrationController::class,"count"])->name("registrations.count");
