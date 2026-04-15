<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isTeacher()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('student.dashboard');
    }
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'classroom'])->prefix('dashboard')->name('student.')->group(function () {
    // Join Class (accessible without classroom)
    Route::get('/join-class', [Student\JoinClassController::class, 'show'])->name('join-class')->withoutMiddleware('classroom');
    Route::post('/join-class', [Student\JoinClassController::class, 'join'])->name('join-class.submit')->withoutMiddleware('classroom');

    // Dashboard
    Route::get('/', [Student\DashboardController::class, 'index'])->name('dashboard');

    // Subject Hub
    Route::get('/subjects', [Student\SubjectController::class, 'index'])->name('subjects.index');

    // Quest Board (hub page + per-subject view)
    Route::get('/quest-board', [Student\QuestBoardController::class, 'index'])->name('quest-board');
    Route::get('/subjects/{subject}/quests', [Student\QuestController::class, 'index'])->name('quests.index');

    // Learning Room (hub page + per-quest material view)
    Route::get('/learning-room', [Student\LearningRoomController::class, 'index'])->name('learning-room');
    Route::get('/quests/{quest}/material', [Student\MaterialController::class, 'show'])->name('materials.show');
    Route::post('/materials/{material}/bookmark', [Student\MaterialController::class, 'toggleBookmark'])->name('materials.bookmark');

    // Quiz Arena (hub page + per-quest quiz view)
    Route::get('/quiz-arena', [Student\QuizArenaController::class, 'index'])->name('quiz-arena');
    Route::get('/quests/{quest}/quiz', [Student\QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quests/{quest}/quiz', [Student\QuizController::class, 'submit'])->name('quizzes.submit');

    // Profile & Inventory
    Route::get('/profile', [Student\ProfileController::class, 'index'])->name('profile');

    // Leaderboard
    Route::get('/leaderboard', [Student\LeaderboardController::class, 'index'])->name('leaderboard');
});

/*
|--------------------------------------------------------------------------
| Admin / Teacher Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teacher'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Quest Builder (combined overview)
    Route::get('/quest-builder', [Admin\QuestBuilderController::class, 'index'])->name('quest-builder');

    // Classroom Management
    Route::resource('classrooms', Admin\ClassroomController::class);

    // Subject Management (nested under classroom)
    Route::get('/classrooms/{classroom}/subjects', [Admin\SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/classrooms/{classroom}/subjects/create', [Admin\SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/classrooms/{classroom}/subjects', [Admin\SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/classrooms/{classroom}/subjects/{subject}/edit', [Admin\SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/classrooms/{classroom}/subjects/{subject}', [Admin\SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/classrooms/{classroom}/subjects/{subject}', [Admin\SubjectController::class, 'destroy'])->name('subjects.destroy');

    // Quest Management (nested under subject)
    Route::get('/subjects/{subject}/quests', [Admin\QuestController::class, 'index'])->name('quests.index');
    Route::get('/subjects/{subject}/quests/create', [Admin\QuestController::class, 'create'])->name('quests.create');
    Route::post('/subjects/{subject}/quests', [Admin\QuestController::class, 'store'])->name('quests.store');
    Route::get('/subjects/{subject}/quests/{quest}/edit', [Admin\QuestController::class, 'edit'])->name('quests.edit');
    Route::put('/subjects/{subject}/quests/{quest}', [Admin\QuestController::class, 'update'])->name('quests.update');
    Route::delete('/subjects/{subject}/quests/{quest}', [Admin\QuestController::class, 'destroy'])->name('quests.destroy');

    // Material Management
    Route::get('/quests/{quest}/material/create', [Admin\MaterialController::class, 'create'])->name('materials.create');
    Route::post('/quests/{quest}/material', [Admin\MaterialController::class, 'store'])->name('materials.store');
    Route::get('/quests/{quest}/material/edit', [Admin\MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/quests/{quest}/material', [Admin\MaterialController::class, 'update'])->name('materials.update');

    // Quiz Management
    Route::get('/quests/{quest}/quizzes', [Admin\QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quests/{quest}/quizzes/create', [Admin\QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quests/{quest}/quizzes', [Admin\QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quests/{quest}/quizzes/{quiz}/edit', [Admin\QuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quests/{quest}/quizzes/{quiz}', [Admin\QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quests/{quest}/quizzes/{quiz}', [Admin\QuizController::class, 'destroy'])->name('quizzes.destroy');

    // Badge Management
    Route::resource('badges', Admin\BadgeController::class);
});
