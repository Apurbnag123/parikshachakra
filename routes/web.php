<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FeeController as AdminFeeController;
use App\Http\Controllers\Admin\LiveClassController as AdminLiveClassController;
use App\Http\Controllers\Admin\NoticeController as AdminNoticeController;
use App\Http\Controllers\Admin\ResultController as AdminResultController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\BatchController as AdminBatchController;
use App\Http\Controllers\Admin\ContactQueryController as AdminContactQueryController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('index');
});
    Route::get('/index', [MyController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Admin register (kept simple; enabled only if no admin exists yet)
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    // Student register (detailed)
    Route::get('/register/student', [AuthController::class, 'showStudentRegister'])->name('student.register');
    Route::post('/register/student', [AuthController::class, 'registerStudent'])->name('student.register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('students', AdminStudentController::class)->except(['show']);
        Route::resource('batches', AdminBatchController::class)->except(['show']);

        Route::get('/fees', [AdminFeeController::class, 'index'])->name('fees.index');
        Route::get('/fees/report', [AdminFeeController::class, 'report'])->name('fees.report');
        Route::get('/fees/{student}', [AdminFeeController::class, 'edit'])->name('fees.edit');
        Route::post('/fees/{student}/account', [AdminFeeController::class, 'updateAccount'])->name('fees.account.update');
        Route::post('/fees/{student}/payment', [AdminFeeController::class, 'storePayment'])->name('fees.payment.store');
        Route::get('/fees/receipt/{payment}', [AdminFeeController::class, 'receipt'])->name('fees.receipt');

        Route::resource('notices', AdminNoticeController::class)->except(['show']);
        Route::resource('live-classes', AdminLiveClassController::class)->except(['show']);
        Route::resource('results', AdminResultController::class)->except(['show', 'edit', 'update']);

        Route::get('/contacts', [AdminContactQueryController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contactQuery}', [AdminContactQueryController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{contactQuery}/resolve', [AdminContactQueryController::class, 'resolve'])->name('contacts.resolve');
        Route::delete('/contacts/{contactQuery}', [AdminContactQueryController::class, 'destroy'])->name('contacts.destroy');
    });

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/', [StudentDashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
    });

Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
