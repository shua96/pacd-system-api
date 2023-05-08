<?php

use App\Models\Clients;
use App\Models\Faqlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API Routes for Client Page
Route::post('/createclient', function (Request $request) {
    return Clients::create([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'age' => $request->age,
        'sex' => $request->sex,
        'contact' => $request->contact,
        'email' => $request->email,
        'address' => $request->address,
        'actionprovided' => $request->actionprovided,
    ]);
});

Route::get('/getclients', function () {
    return Clients::all();
});

Route::post('/updateclient', function (Request $request) {
    $client = Clients::find($request->id);

    $client->firstname = $request->firstname;
    $client->middlename = $request->middlename;
    $client->lastname = $request->lastname;
    $client->age = $request->age;
    $client->sex = $request->sex;
    $client->contact = $request->contact;
    $client->email = $request->email;
    $client->address = $request->address;
    $client->actionprovided = $request->actionprovided;

    return $client->save();
});

Route::post('/deleteClient', function (Request $request) {
    return Clients::find($request->id)->delete();
});

//API Routes for FAQ List Page

Route::post('/createfaq', function (Request $request) {
    return Faqlists::create([
        'name' => $request->name,
    ]);
});

Route::post('/updatefaq', function (Request $request) {
    $faqlist = Faqlists::find($request->id);

    $faqlist->name = $request->name;

    return $faqlist->save();
});

Route::get('/getfaq', function () {
    return Faqlists::all();
});
