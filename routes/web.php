<?php

use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\AppointmentsCalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Backend\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::resource('profile', Backend\ProfileController::class);
    Route::put('change-password/{id}', [Backend\ProfileController::class, 'changePassword'])->name('change-password');



});
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Users Routes
    Route::resource('SalesPeople', Backend\SalespersonController::class);
    Route::resource('Vehicles', Backend\VehiclesController::class);

    Route::get('salesperson-datatable', [Backend\SalespersonController::class, 'dataTable'])->name('salesperson-datatable');

    Route::resource('users', Backend\UserController::class);
    Route::get('users.form', [Backend\UserController::class,'Dealershipcreate'])->name('users.form');
    Route::get('users-dt', [Backend\UserController::class, 'dataTable'])->name('users-datatable');
    Route::put('users.form', [Backend\UserController::class,'Dealeredit'])->name('users.form');
    
    Route::post('dealer.store', [Backend\UserController::class,'DealersStore'])->name('dealer.store');

    // Roles Routes
    Route::resource('roles', Backend\RoleController::class);
    Route::get('roles-dt', [Backend\RoleController::class, 'dataTable'])->name('roles-datatable');

    // Invitation Routes
    Route::get('/invite', [InvitationController::class, 'inviteForm'])->name('invite.form');
    Route::post('/invite', [InvitationController::class, 'invite'])->name('invite.user');
});

// Frontend Routes
Route::redirect('/', '/login');
