<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Models\Competition;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  


// PAGES ROUTES
Route::get('/', [CompetitionController::class, 'index'])->name('home');
Route::get('/competition/{id}', [CompetitionController::class, 'show']);
// TEAM ROUTS
Route::get('/competition/login/{category}', [TeamController::class, 'create'])->middleware('auth');
Route::post('/individualSign/create', [TeamController::class, 'indevidualsSore'])->middleware('auth');
Route::post('/teamSign/create', [TeamController::class, 'teamStore'])->middleware('auth');

// AUTHENTICATION ROUTES
// Get who are you
Route::get('/login', [UserController::class, 'show'])->name('login')->middleware('guest');
// Get the form for specific priviledge 
Route::get('/login/{priviledge}', [UserController::class, 'showForms'])->middleware('guest');
// Regist
Route::post('/{priviledge}/regist', [UserController::class, 'regist'])->middleware('guest');
// Get Login as student form
Route::get('/login/student/login', [UserController::class, 'login'])->middleware('guest');
// Authentication / Login process as student
Route::post('/login/student/authentication', [UserController::class, 'studentAuthentication']);
// Authentication / Login process as admin
Route::post('/login/admin/authentication', [UserController::class, 'adminAuthentication']);

// Logout
Route::post('/logout', [UserController::class, 'logout']);


// DASHBOARD RPUTES
// Get all competitions(admin)
Route::get('/competitions/dashboard', [UserController::class, 'allCompetitions'])->middleware(['auth', 'admin_or_superadmin']);
// Get create competition form(admin)
Route::get('/add/competition', [CompetitionController::class, 'storeCompetitionsForm'])->middleware(['auth', 'admin_or_superadmin']);
// Delete competition(admin)
Route::delete('/delete/competition/{competition}', [CompetitionController::class, 'delete'])->middleware(['auth', 'admin_or_superadmin']);
// Show edit form
Route::get('/update/competition/{competition}', [CompetitionController::class, 'edit'])->middleware(['auth', 'admin_or_superadmin']);
// Edit competition(admin)
Route::put('/update/{id}/competition', [CompetitionController:: class, 'update'])->middleware(['auth', 'admin_or_superadmin']);
// Get create events form after collecting competition data(admin)
Route::post('/add/competition/events', [CompetitionController::class, 'eventsForm'])->middleware(['auth', 'admin_or_superadmin']);
// Add competition's events
Route::get('/add/events/{id}', [CompetitionController::class, 'displayEvents'])->middleware(['auth', 'admin_or_superadmin']);
// Set the events + Create the competition(admin)
Route::post('/add/competition/events/create', [CompetitionController::class, 'storeCompetition'])->middleware(['auth', 'admin_or_superadmin']);
// Get add score form(admin)
Route::get('/add/scores/{id?}', [ScoreController::class, 'storeScoreForm'])->middleware(['auth', 'admin_or_superadmin']);
// Add score(admin)
Route::put('/add/score', [ScoreController::class, 'add'])->middleware(['auth', 'admin_or_superadmin']);
// Get all results(admin)
Route::get('/results', [ScoreController::class, 'results'])->middleware(['auth', 'admin_or_superadmin']);
// Get team(admin)
Route::get('/teams', [TeamController::class, 'getTeams'])->middleware(['auth', 'admin_or_superadmin']);
// Get individuals(admin)
Route::get('/individuals', [TeamController::class, 'getIndividual'])->middleware(['auth', 'admin_or_superadmin']);
// Get all students in the website(admin)
Route::get('/students', [UserController::class, 'getUsers'])->middleware(['auth', 'admin_or_superadmin']);

// PROFILE RPUTES
Route::get('/profile/{id}', [UserController::class, 'getProfile'])->middleware(['auth']);
Route::get('/setting/{id}', [UserController::class, 'getSetting'])->middleware(['auth']);
Route::put('/setting/{id}/edit', [UserController::class, 'editProfile'])->middleware(['auth']);
