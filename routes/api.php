<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("allDesignations","API@getDesignations");
Route::post("saveCompany","API@SaveContact");
Route::get("fetchContactEmails","API@GetEmailsByType");
Route::get("getContactInfo/{id}/{type}","API@ContactInfo");
Route::post("UpdateContactInfo","API@UpdateContactInfo");


