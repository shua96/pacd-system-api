<?php

use App\Models\AccountingFaqs;
use App\Models\AdminFaqs;
use App\Models\AssessmentClients;
use App\Models\CertififactionFaqs;
use App\Models\Clients;
use App\Models\Faqlists;
use App\Models\Feedbacks;
use App\Models\ProcurementFaqs;
use App\Models\RegistrarFaqs;
use App\Models\TrainingFaqs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API Routes for Client Page
Route::post('/createclient', function (Request $request) {
    return Clients::create([
        'name' => $request->name,
        'age' => $request->age,
        'sex' => $request->sex,
        'address' => $request->address,
        'contact' => $request->contact,
        'feedbacks' => $request->feedbacks,
        'email' => $request->email,
        'reason' => $request->reason,
        'actionprovided' => $request->actionprovided,
    ]);
});

Route::get('/getclients', function () {
    $clients = Clients::all();
    $maleCount = $clients->where('sex', 'Male')->count();
    $femaleCount = $clients->where('sex', 'Female')->count();
    $assessmentCount = Clients::where('reason', 'Assessment & Certification')->count();
    $registrarCount = Clients::where('reason', 'Registrar')->count();
    $trainingCount = Clients::where('reason', 'Training')->count();
    $othersCount = Clients::where('reason', 'Others (Procurement, Finance and Admin, Scholarship)')->count();

    $ageGroups = [
        '15-25',
        '26-35',
        '36-45',
        '46-55',
        '56-65',
        '66 and Above',
        'Age not indicated'
    ];

    $ageCounts = array_fill_keys($ageGroups, 0);

    foreach ($clients as $client) {
        if ($client->age >= 15 && $client->age <= 25) {
            $ageCounts['15-25']++;
        } elseif ($client->age >= 26 && $client->age <= 35) {
            $ageCounts['26-35']++;
        } elseif ($client->age >= 36 && $client->age <= 45) {
            $ageCounts['36-45']++;
        } elseif ($client->age >= 46 && $client->age <= 55) {
            $ageCounts['46-55']++;
        } elseif ($client->age >= 56 && $client->age <= 65) {
            $ageCounts['56-65']++;
        } elseif ($client->age >= 66) {
            $ageCounts['66 and Above']++;
        } else {
            $ageCounts['Age not indicated']++;
        }
    }

    return array_merge($ageCounts, [
        'maleCount' => $maleCount,
        'femaleCount' => $femaleCount,
    ],
    [
        'assessmentCount' => $assessmentCount,
        'registrarCount' => $registrarCount,
        'trainingCount' => $trainingCount,
        'othersCount' => $othersCount,
        
    ]);
    
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
        'name' => $request->name,
        'age' => $request->age,
        'sex' => $request->sex,
        'course_year' => $request->course_year,
        'qualification' => $request->qualification,
        'school' => $request->school,
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

//API FOR CREATING ADMINISTRATIVE ACCOUNTS

Route::post('/createaccount', function (Request $request) {
    return User::create([
        'access' => $request->access,
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'contact' => $request->contact,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
});

Route::get('/getaccounts', function () {
    return User::all();
});


Route::post('/updateaccount', function (Request $request) {
    $user = User::find($request->id);

    $user->firstname = $request->firstname;
    $user->middlename = $request->middlename;
    $user->lastname = $request->lastname;
    $user->contact = $request->contact;
    return $user->save();
});


Route::post('/deleteaccount', function (Request $request) {
    return User::find($request->id)->delete();
});


//FEEDBACKS

Route::post('/createfeedback', function (Request $request) {
    return Feedbacks::create([
        'rating' => $request->rating,
    ]);
});
