<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\company;
use App\Http\Controllers\HomeController;
use App\Models\jobseekers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\locController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\jobseeker;
use App\Http\Controllers\JobPostSkillShow;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\cv;

/////////////////////////////////////Welcome/////////////////////////////////////////////////////////
Route::get('/', [HomeController::class, 'index'])->name('index');

//login
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
//jobsummary
Route::get('/jobsummary/{id}', [HomeController::class, 'jobSummary'])->name('jobsummary');
//main  jobfeedpage
Route::get('/jobfeed', [HomeController::class, 'jobfeed'])->name('jobfeed');

//about  Route
Route::get('/About', function () {
    return view('About');
})->name('About')->middleware('guest');
//Contact
Route::get('/Contact', function () {
    return view('Contact');
})->name('Contact');

//contactus handler

Route::post('/contact Us', [HomeController::class, 'handleContactUs'])->name('contact_us');

//////////////////////////////////WelcomeEnds/////////////////////////////////////////////////////////







/////////////////////////////////////////RestPassword///////////////////////////////////////////////

// show form on click rest pass button 
Route::get('/showForgotPasswordform', [HomeController::class, 'showForgotPasswordform'])->name('showForgotPasswordform')->middleware('guest');

//after user put its emial process it

Route::post('/processForgotPasswordform', [HomeController::class, 'processForgotPasswordform'])->name('processForgotPasswordform');

//show rest password form from mial with token

Route::get('/PasswordResetform{token}', [HomeController::class, 'PasswordResetform'])->name('PasswordResetform');

//now reset password

Route::post('/ResetPassword', [HomeController::class, 'ResetPassword'])->name('ResetPassword');
////////////////////////////////////////////RestPasswordEnds/////////////////////////////////////////







//////////////////////////////////////Company///////////////////////////////////////////////////////

//company dashboard
Route::get('/companyDashboard', [company::class, 'showCompanyDashboard'])->name('companyDashboard')->middleware('auth');
//createjob
Route::get('/create-job', [company::class, 'show_create_job'])->name('show_create_job')->middleware('auth');

//Applicants
Route::get('/Applicants', [company::class, 'Applicants'])->name('companyapplicant')->middleware('auth');

////companyinf0
Route::get('/CompanInfo/{id}', [company::class, 'CompanInfo'])->name('CompanInfo');

//companyUpdateProfile

Route::post('/companyUpdateProfile', [company::class, 'companyUpdateProfile'])->name('companyUpdateProfile');


///company Browse candidate for show

Route::get('/browse_candidate', [company::class, 'browse_candidate'])->name('browse_candidate')->middleware('auth');

//candidate_Search_filter

Route::post('/candidate_Search_filter', [company::class, 'candidate_Search_filter'])->name('candidate_Search_filter')->middleware('auth');


///rate a company

Route::post('/RateCompany', [company::class, 'RateCompany'])->name('RateCompany')->middleware('auth');

///deleteAppliant who apply

Route::delete('/delApp/{id}', [company::class, 'applicantDelete'])->name('applicantDelete');


///change status of job
Route::get('/changeStatus', [company::class, 'changeStatus'])->name('changeStatus');
///post a job

Route::post('/jobposted', [company::class, 'jobpost'])->name('jobposted')->middleware('auth');

//delete a job

Route::get('/DeleteJob/{id}', [company::class, 'DeleteJob'])->name('DeleteJob')->middleware('auth');

//updatejob
Route::post('/jobalter', [company::class, 'jobalter'])->name('jobalter');
//deleete profile

Route::get('/deleteProfile/{id}', [company::class, 'deleteProfile'])->name('deleteProfile')->middleware('auth');
////////////////////////////////CompanyEnds///////////////////////////////////////////////////////







////////////////////////////jobseeker/////////////////////////////////////////////////////////////////

// jobsseeker dahboard

Route::get('/jobseekerDashboard', [jobseeker::class, 'showDashboard'])->name('jobseekerDashboard')->middleware('auth');
//jobseekerUpdateProfile

Route::post('/jobseekerUpdateProfile', [jobseeker::class, 'jobseekerUpdateProfile'])->name('jobseekerUpdateProfile');

//jobseeker setting Route for showing pic only initally

Route::get('JobseekerProfileSetting', [jobseeker::class, 'JobseekerProfileSetting'])->name('JobseekerProfileSetting');
//savejob
Route::get('/savejob/{id}', [HomeController::class, 'savejob'])->name('savejob');

//jobseeker deleteSavejob
Route::delete('/jobdestroy/{id}', [jobseeker::class, 'jobdestroy'])->name('jobdestroy')->middleware('auth');
//apply on job
Route::get('/jobapply/{id}', [jobseeker::class, 'jobapply'])->name('jobapply')->middleware('auth');
//delete a apply job
Route::delete('/applyjobdelete/{id}', [jobseeker::class, 'applyjobdelete'])->name('applyjobdelete');
////////////////////////jobseekerEnds/////////////////////////////////////////////////////////////////








////////////////////////admin////////////////////////////////////////////////////////////////////////

//admingShowing
Route::get('/contact Us', [Admin::class, 'Admin_messages_ContactUs'])->name('Admin_messages')->middleware('auth');

//admindelete

Route::delete('/message-delete/{id}', [Admin::class, 'AdminDeleteMessage'])->name('Admin_messages-delete')->middleware('auth');

Route::get('/AdminIndex', [Admin::class, 'AdminIndex'])->name('AdminIndex')->middleware('auth');
//adminDeleteUse
Route::delete('/AdminDeleteUser/{id}', [Admin::class, 'DeleteUser'])->name('AdminDeleteUser')->middleware('auth');
/////block/Unblock
Route::post('/Admin_Block_Unblock_User/{id}', [Admin::class, 'Block_Unblock_User'])->name('Admin_Block_Unblock_User')->middleware('auth');
///adminjobs//
Route::get('/adminjobs', [Admin::class, 'adminjobs'])->name('adminjobs')->middleware('auth');
//admi n delete job

Route::delete('/AdminDeleteJob/{id}', [Admin::class, 'AdminDeleteJob'])->name('AdminDeleteJob')->middleware('auth');
//searchjob
Route::get('/Search', [Admin::class, 'Search'])->name('Search')->middleware('auth');
//add skill
// show
Route::get('/add_skill_show', function () {

    if (auth()->user()->role === 'admin') {


        return view('Admin.addSkill');
    } else {

        abort(404);
    }
})->name('add_skill_show')->middleware('auth');
//post
Route::post('/add_skill', [Admin::class, 'add_skill'])->name('add_skill')->middleware('auth');
//user filter
    Route::get('/user_filters', [Admin::class, 'filter'])->name('user_filters')->middleware('auth');
////////////////////adminEnds//////////////////////////////////////////////////////////////////////








///////////////////////////////////////Userreg///////////////////////////////////////////////////////

//both hit this for reg
ROute::post('/User_Registeration', [RegisterController::class, 'Userreg'])->name('User_Registeration');

//a notice display route

Route::get('email/verify', function () {
    return view('verification_notice');
})->name('verification.notice');

//a resend link
Route::post('/email/verification-link', [RegisterController::class, 'emailTokenGenerator'])->name('verification.send');

// a verification process

Route::get('/emailVerification-Process{token}', [RegisterController::class, 'emailVerificationProcess'])->name('emailVerificationProcess');

//a main signup page routes for user type

//companyRegisteration show step-1
Route::get('/user_registeration_01', function () {
    return view('UserRegComp');
})->name('UserReg_Comp');
///jobseekerRegisteration show step-1
Route::get('/user_registeration_02', function () {
    return view('UserRegJs');
})->name('UserReg_Js');

//a main signup page routes for user type ends

//companyRegisteration step-2 (unused)
Route::get('/companyRegisteration', [locController::class, 'showRegistrationForm'])->name('companyRegisteration')->middleware('guest');

//jobseeker  reg step-2 (unused)
Route::get('/jobseekerRegisteration', function () {
    return view('jobseekerreg');
})->name('jobseekerRegisteration')->middleware('guest');

// registerration from sceond step on role based
Route::post('/register_2', [RegisterController::class, 'RegisterationBoth'])->name('register');

//login
Route::post('/Loginuser', [RegisterController::class, 'Login'])->name('Loginuser');
//logout
Route::post('/Logout', [logoutController::class, 'Logout'])->name('Logout')->middleware('auth');
//google
Route::get('/googleLogin', [RegisterController::class, 'googleLogin'])->name('googleLogin');
Route::get('/auth/google/callback', [RegisterController::class, 'googlehandle']);
//mainSignUPPage
Route::get('/signup', function () {
    return view('mainSignUPPage');
})->name('signup')->middleware('guest');

////////////////////////////////////UserregEnds///////////////////////////////////////////////////////








//////////////////////////////////////////////////////cv////////////////////////////////////////////

//show
Route::view('/cv-data', 'cvDataTake')->name('cvDataTake');
//post
Route::post('cv_validator/{inspect}', [cv::class, 'cv_validator'])->name('cv_validator');
//cv for jobseeker
Route::get('/cv-Preview', [cv::class, 'cv_Preview'])->name('cv_preview');
//Layout-Selection show options
Route::get('/Layout-Selection', function () {

    return view('cv_selection');
})->name('Layout-Selection_view');
//Layout-chossed
Route::get('/Layout-Selection/{layout}', [cv::class, 'cv_Preview'])->name('Layout-Selection');
//update form
Route::get('/showEditForm', [cv::class, 'showEditForm'])->name('showEditForm');
//browse candidate company
Route::get('/browseCandidateCompany/{id}', [cv::class, 'browseCandidateCompany'])->name('browseCandidateCompany');



////////////////////////////////////////////////////cvEnds////////////////////////////////////////////
