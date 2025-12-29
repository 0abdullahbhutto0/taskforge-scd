<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store'])->name('login');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'create'])->middleware('auth');

// Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [UserManagementController::class, 'index']);
    Route::post('/users/{id}/approve', [UserManagementController::class, 'approve']);
    Route::post('/users/{id}/reject', [UserManagementController::class, 'reject']);
    Route::post('/users/{id}/assign-role', [UserManagementController::class, 'assignRole']);
    Route::post('/search', [AdminController::class, 'search']);
});

// Manager Routes
Route::middleware('auth')->prefix('manager')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'dashboard']);
    Route::get('/employees/create', function() {
        return view('manager.create-employee');
    });
    Route::post('/employees', [UserManagementController::class, 'createEmployee']);
    Route::post('/search', [ManagerController::class, 'search']);
});

// Employee Routes
Route::middleware('auth')->prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard']);
    Route::post('/search', [EmployeeController::class, 'search']);
});

// Workspace Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/workspaces', [WorkspaceController::class, 'index']);
    Route::get('/workspaces/create', [WorkspaceController::class, 'create']);
    Route::post('/workspaces', [WorkspaceController::class, 'store']);
    Route::get('/workspaces/{id}', [WorkspaceController::class, 'show']);
});

// Task Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/create', [TaskController::class, 'create']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::post('/tasks/{id}/status', [TaskController::class, 'updateStatus']);
    Route::post('/tasks/{id}/comments', [TaskController::class, 'addComment']);
});

// Announcement Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::get('/announcements/create', [AnnouncementController::class, 'create']);
    Route::post('/announcements', [AnnouncementController::class, 'store']);
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);
});