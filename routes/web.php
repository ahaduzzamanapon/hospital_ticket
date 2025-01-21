<?php

use App\Http\Controllers\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\SliderController;

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

    Route::group(['middleware' => 'auth:admin'], function () {

        // Route For Departments
       Route::get('/departments',[DepartmentController::class,'index'])->name('admin.departments.index'); 
       Route::get('/departments/create',[DepartmentController::class,'create'])->name('admin.departments.create'); 
       Route::post('/departments/store',[DepartmentController::class,'store'])->name('admin.departments.store'); 
       Route::get('/departments/show/{id}',[DepartmentController::class,'show'])->name('admin.departments.show');
       Route::get('/departments/edit/{id}',[DepartmentController::class,'edit'])->name('admin.departments.edit');
       Route::put('/departments/update/{id}',[DepartmentController::class,'update'])->name('admin.departments.update');
       Route::delete('/departments/delete/{id}',[DepartmentController::class,'destroy'])->name('admin.departments.destroy'); 

       // Route For Settings
       Route::get('/settings',[SettingController::class,'index'])->name('admin.settings.index'); 
       Route::get('/settings/create',[SettingController::class,'create'])->name('admin.settings.create'); 
       Route::post('/settings/store',[SettingController::class,'store'])->name('admin.settings.store'); 
       Route::get('/settings/show/{id}',[SettingController::class,'show'])->name('admin.settings.show');
       Route::get('/settings/edit/{id}',[SettingController::class,'edit'])->name('admin.settings.edit');
       Route::put('/settings/update/{id}',[SettingController::class,'update'])->name('admin.settings.update');
       Route::delete('/settings/delete/{id}',[SettingController::class,'destroy'])->name('admin.settings.destroy'); 

       // Route For Time Sliders
       Route::get('/sliders',[SliderController::class,'index'])->name('admin.sliders.index'); 
       Route::get('/sliders/create',[SliderController::class,'create'])->name('admin.sliders.create'); 
       Route::post('/sliders/store',[SliderController::class,'store'])->name('admin.sliders.store');
       Route::get('/sliders/edit/{id}',[SliderController::class,'edit'])->name('admin.sliders.edit');
       Route::put('/sliders/update/{id}',[SliderController::class,'update'])->name('admin.sliders.update');
       Route::delete('/sliders/delete/{id}',[SliderController::class,'destroy'])->name('admin.sliders.destroy');

    });

});
