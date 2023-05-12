<?php

use App\Models\AccountingFaqs;
use App\Models\AdminFaqs;
use App\Models\AssessmentClients;
use App\Models\CertififactionFaqs;
use App\Models\Clients;
use App\Models\Faqlists;
use App\Models\ProcurementFaqs;
use App\Models\RegistrarFaqs;
use App\Models\TrainingFaqs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


//API Routes for Login/Logout Page

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return Auth::user();
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::post('/logout', function () {
    return Auth::logout();
});

//API Routes for Assessment Clients Page

Route::post('/createassessmentclient', function (Request $request) {
    return AssessmentClients::create([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'age' => $request->age,
        'sex' => $request->sex,
        'qualification' => $request->qualification,
        'course_year' => $request->course_year,
        'address' => $request->address,
        'actionprovided' => $request->actionprovided,
    ]);
});

Route::get('/get-assessmentclients', function () {
    return AssessmentClients::all();
});

Route::post('/update-assessmentclient', function (Request $request) {
    $client = AssessmentClients::find($request->id);

    $client->firstname = $request->firstname;
    $client->middlename = $request->middlename;
    $client->lastname = $request->lastname;
    $client->age = $request->age;
    $client->sex = $request->sex;
    $client->qualification = $request->qualification;
    $client->course_year = $request->course_year;
    $client->address = $request->address;
    $client->actionprovided = $request->actionprovided;

    return $client->save();
});

Route::post('/delete-assessmentclient', function (Request $request) {
    return AssessmentClients::find($request->id)->delete();
});

//ROUTES FOR TRAINING FAQS

Route::post('/createtrainingfaqs', function (Request $request) {
    return TrainingFaqs::create([
        'question' => $request->question,
        'answer' => $request->answer,
    ]);
});

Route::get('/gettrainingfaqs', function () {
    return TrainingFaqs::all();
});

Route::post('/updatetrainingfaqs', function (Request $request) {
    $client = TrainingFaqs::find($request->id);

    $client->question = $request->question;
    $client->answer = $request->answer;

    return $client->save();
});

Route::post('/deletetrainingfaqs', function (Request $request) {
    return TrainingFaqs::find($request->id)->delete();
});

//ROUTES FOR REGISTRAR FAQS

Route::post('/createregistrarfaqs', function (Request $request) {
    return RegistrarFaqs::create([
        'question' => $request->question,
        'answer' => $request->answer,
    ]);
});

Route::get('/getregistrarfaqs', function () {
    return RegistrarFaqs::all();
});

Route::post('/updateregistrarfaqs', function (Request $request) {
    $client = RegistrarFaqs::find($request->id);

    $client->question = $request->question;
    $client->answer = $request->answer;

    return $client->save();
});

Route::post('/deleteregistrarfaqs', function (Request $request) {
    return RegistrarFaqs::find($request->id)->delete();
});

//ROUTES FOR CERTIFICATION FAQS

Route::post('/createcertificationfaqs', function (Request $request) {
    return CertififactionFaqs::create([
        'question' => $request->question,
        'answer' => $request->answer,
    ]);
});

Route::get('/getcertificationfaqs', function () {
    return CertififactionFaqs::all();
});

Route::post('/updatecertificationfaqs', function (Request $request) {
    $client = CertififactionFaqs::find($request->id);

    $client->question = $request->question;
    $client->answer = $request->answer;

    return $client->save();
});

Route::post('/deletecertificationfaqs', function (Request $request) {
    return CertififactionFaqs::find($request->id)->delete();
});

//ROUTES FOR PROCUREMENT FAQS

Route::post('/createprocurementfaqs', function (Request $request) {
    return ProcurementFaqs::create([
        'question' => $request->question,
        'answer' => $request->answer,
    ]);
});

Route::get('/getprocurementfaqs', function () {
    return ProcurementFaqs::all();
});

Route::post('/updateprocurementfaqs', function (Request $request) {
    $client = ProcurementFaqs::find($request->id);

    $client->question = $request->question;
    $client->answer = $request->answer;

    return $client->save();
});

Route::post('/deleteprocurementfaqs', function (Request $request) {
    return ProcurementFaqs::find($request->id)->delete();
});

//ROUTES FOR ACCOUNTING FAQS

Route::post('/createaccountingfaqs', function (Request $request) {
    return AccountingFaqs::create([
        'question' => $request->question,
        'answer' => $request->answer,
    ]);
});

Route::get('/getaccountingfaqs', function () {
    return AccountingFaqs::all();
});

Route::post('/updateaccountingfaqs', function (Request $request) {
    $client = AccountingFaqs::find($request->id);

    $client->question = $request->question;
    $client->answer = $request->answer;

    return $client->save();
});

Route::post('/deleteaccountingfaqs', function (Request $request) {
    return AccountingFaqs::find($request->id)->delete();
});

//ROUTES FOR ADMIN FAQS

Route::post('/createadminfaqs', function (Request $request) {
    return AdminFaqs::create([
        'question' => $request->question,
        'answer' => $request->answer,
    ]);
});

Route::get('/getadminfaqs', function () {
    return AdminFaqs::all();
});

Route::post('/updateadminfaqs', function (Request $request) {
    $client = AdminFaqs::find($request->id);

    $client->question = $request->question;
    $client->answer = $request->answer;

    return $client->save();
});

Route::post('/deleteadminfaqs', function (Request $request) {
    return AdminFaqs::find($request->id)->delete();
});
