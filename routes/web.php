<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/', 'HomeController@index')->name('/');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/book_ticket', 'BookTicket@index')->name('book_ticket');
Route::post('/sendOtp', 'BookTicket@sendOtp')->name('sendOtp');
Route::get('/resend', 'BookTicket@resend')->name('resend');
Route::post('/verifyOtp', 'BookTicket@verifyOtp')->name('verifyOtp');
Route::get('/patient_dashboard', 'BookTicket@patient_dashboard')->name('patient_dashboard');

Route::post('/book_ticket_for_patient', 'BookTicket@book_ticket_for_patient')->name('book_ticket_for_patient');
Route::get('/patientHistory', 'BookTicket@patientHistory')->name('patientHistory');
Route::get('/patientProfile', 'BookTicket@patientProfile')->name('patientProfile');
Route::get('/patient_logout', 'BookTicket@patient_logout')->name('patient_logout');
Route::post('/get_time_slot_by_department', 'BookTicket@get_time_slot_by_department')->name('get_time_slot_by_department');

Route::post('/patientRegistration', 'BookTicket@patientRegistration')->name('patientRegistration');

//You need declear your success & fail route in "app\Middleware\VerifyCsrfToken.php"
Route::post('success',[\App\Http\Controllers\BookTicket::class,'success'])->name('success');
Route::post('fail',[\App\Http\Controllers\BookTicket::class,'fail'])->name('fail');
Route::get('cancel',[\App\Http\Controllers\BookTicket::class,'cancel'])->name('cancel');
Route::get('payment_process/{ticket_id}',[\App\Http\Controllers\BookTicket::class,'payment_process'])->name('payment_process');
Route::get('ticket_print/{ticket_id}',[\App\Http\Controllers\BookTicket::class,'ticket_print'])->name('ticket_print');



Route::get('reaction_on_sassoon/{ticket_id}',[\App\Http\Controllers\BookTicket::class,'reaction_on_sassoon'])->name('reaction_on_sassoon');





/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);


    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
