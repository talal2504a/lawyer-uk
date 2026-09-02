<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LawyerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LawyerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [LawyerController::class, 'home'])->name('home');
Route::get('/lawyer/profile/{id}', [LawyerController::class, 'show'])->name('lawyer.public.profile');
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');

// Guest routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public booking route (no auth required)
Route::post('/book/{lawyerId}', [LawyerController::class, 'guestBooking'])->name('guest.book');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer routes
Route::prefix('customer')->name('customer.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/search', [CustomerController::class, 'search'])->name('search');
    Route::get('/lawyer/{id}', [CustomerController::class, 'lawyerProfile'])->name('lawyer.profile');
    Route::post('/book/{lawyerId}', [CustomerController::class, 'bookAppointment'])->name('book');
    Route::get('/appointments', [CustomerController::class, 'myAppointments'])->name('appointments');
    Route::post('/appointments/{id}/cancel', [CustomerController::class, 'cancelAppointment'])->name('appointments.cancel');
    // Customer Chat
    Route::get('/chats/{appointmentId}', [CustomerController::class, 'getChats'])->name('chats.get');
    Route::post('/chats/{appointmentId}/send', [CustomerController::class, 'sendChat'])->name('chats.send');
    Route::get('/chat/{appointmentId}', [CustomerController::class, 'chatView'])->name('chat');
});

// Lawyer routes
Route::prefix('lawyer')->name('lawyer.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [LawyerDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [LawyerDashboardController::class, 'myProfile'])->name('profile');
    Route::post('/profile', [LawyerDashboardController::class, 'updateProfile'])->name('profile.update');

    // Cases Management
    Route::get('/cases', [LawyerDashboardController::class, 'cases'])->name('cases');
    Route::get('/cases/{id}', [LawyerDashboardController::class, 'caseDetail'])->name('case.detail');
    Route::post('/cases/{id}/accept', [LawyerDashboardController::class, 'acceptCase'])->name('case.accept');
    Route::post('/cases/{id}/reject', [LawyerDashboardController::class, 'rejectCase'])->name('case.reject');

    // Chat System (AJAX)
    Route::get('/chats/{appointmentId}', [LawyerDashboardController::class, 'getChats'])->name('chats.get');
    Route::post('/chats/{appointmentId}/send', [LawyerDashboardController::class, 'sendChat'])->name('chats.send');

    // Practice Areas Management
    Route::post('/practice-area', [LawyerDashboardController::class, 'addPracticeArea'])->name('practice-area.add');
    Route::delete('/practice-area/{id}', [LawyerDashboardController::class, 'deletePracticeArea'])->name('practice-area.delete');

    // Legacy
    Route::get('/appointments', [LawyerDashboardController::class, 'appointments'])->name('appointments');
    Route::post('/appointments/{id}/status', [LawyerDashboardController::class, 'updateAppointmentStatus'])->name('appointments.status');
    Route::get('/availability', [LawyerDashboardController::class, 'availability'])->name('availability');
    Route::post('/availability', [LawyerDashboardController::class, 'addTimeSlot'])->name('availability.add');
    Route::delete('/availability/{id}', [LawyerDashboardController::class, 'deleteTimeSlot'])->name('availability.delete');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/customers', [AdminDashboardController::class, 'customers'])->name('customers');
    Route::delete('/customers/{id}', [AdminDashboardController::class, 'deleteCustomer'])->name('customers.delete');

    Route::get('/lawyers', [AdminDashboardController::class, 'lawyers'])->name('lawyers');
    Route::post('/lawyers/{id}/approve', [AdminDashboardController::class, 'approveLawyer'])->name('lawyers.approve');
    Route::post('/lawyers/{id}/reject', [AdminDashboardController::class, 'rejectLawyer'])->name('lawyers.reject');
    Route::delete('/lawyers/{id}', [AdminDashboardController::class, 'deleteLawyer'])->name('lawyers.delete');

    Route::get('/specializations', [AdminDashboardController::class, 'specializations'])->name('specializations');
    Route::post('/specializations', [AdminDashboardController::class, 'addSpecialization'])->name('specializations.add');
    Route::put('/specializations/{id}', [AdminDashboardController::class, 'updateSpecialization'])->name('specializations.update');
    Route::delete('/specializations/{id}', [AdminDashboardController::class, 'deleteSpecialization'])->name('specializations.delete');

    Route::get('/appointments', [AdminDashboardController::class, 'appointments'])->name('appointments');
});