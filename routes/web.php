<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('home');
})->name('welcome');
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('/login/author', [LoginController::class, 'showAuthorLoginForm'])->name('author.login');
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/login/author', [LoginController::class, 'authorLogin'])->name('author.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    return view('/auth/logout');
})->name('logout.page');

Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register');
Route::get('/register/author', [RegisterController::class, 'showAuthorRegisterForm'])->name('author.register');
Route::post('/register/admin', [RegisterController::class, 'createAdmin'])->name('admin.register.submit');
Route::post('/register/author', [RegisterController::class, 'createAuthor'])->name('author.register.submit');
Route::group(['middleware' => 'auth:author'], function () { 
    Route::view('/author', 'author'); 
}); 


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // Show forgot password form
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // Handle email and generate OTP
Route::get('/reset-password', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp'); // Show OTP verification form
Route::post('/reset-password', [ForgotPasswordController::class, 'verifyOtp'])->name('password.otp.verify'); // Verify OTP and reset password

 
Route::group(['middleware' => 'auth:admin'], function () { 
    Route::view('/admin', 'admin'); 
}); 
Route::get('/projects', [ProjectController::class, 'getOpenProjects'])->name('projects.index');
Route::get('/projects/ownedProjects', [ProjectController::class, 'getOwnedProjects'])->name('projects.ownedProjects');
Route::get('/projects/biddedProjects', [ProjectController::class, 'getBiddedProjects'])->name('projects.biddedProjects');
Route::get('/projects/bidProjects', [ProjectController::class, 'getBidProjects'])->name('projects.bidProjects');

Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('/projects', [ProjectController::class,'store'])->name('projects.store');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/projects/{project}/bids/create', [BidController::class, 'create'])->name('bids.create');
Route::post('/projects/{project}/bids', [BidController::class, 'store'])->name('bids.store');

Route::get('/projects/{project}/bids/create', [BidController::class, 'create'])->name('bids.create');
Route::post('/projects/{project}/bids', [BidController::class, 'store'])->name('bids.store');
Route::get('/projects/{project}/bids', [BidController::class, 'showBids'])->name('bids.showProjectbids');
Route::post('/bids/{bid}/assign', [BidController::class, 'assign'])->name('bids.assign');
Route::get('/bids/{bid}/edit', [BidController::class, 'edit']); //for freelancer to edit the submited bid
Route::put('/bids/{bid}', [BidController::class, 'update']); //for freelancer to update the submitted bid


Route::get('/projects/{project}/milestones/create', [MilestoneController::class, 'create'])->name('milestones.create');
Route::post('projects/{project}/milestones', [MilestoneController::class,'store'])->name('milestones.store');

Route::get('/milestones/{milestone}/edit', [MilestoneController::class,'edit'])->name('milestones.edit');
Route::put('/milestones/{milestone}', [MilestoneController::class, 'handle'])->name('milestones.handle');
// Route::put('/milestones/{milestone}', [MilestoneController::class, 'ownerUpdate'])->name('milestones.ownerUpdate');
// Route::put('/milestones/{milestone}', [MilestoneController::class, 'ownerApprove'])->name('milestones.ownerApprove');
// Route::put('/milestones/{milestone}', [MilestoneController::class, 'freelanceUpdate'])->name('milestones.freelanceUpdate');

Route::get('/milestones/{milestone}/payment', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/milestones/{milestone}/payment', [PaymentController::class, 'store'])->name('payments.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
