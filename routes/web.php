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

// Static Pages
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/support', 'pages.support')->name('support');

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

    // Guild Selection (accessible without active classroom)
    Route::get('/guild-select', [Student\GuildSelectController::class, 'index'])->name('guild-select')->withoutMiddleware('classroom');
    Route::post('/guild-select', [Student\GuildSelectController::class, 'set'])->name('guild-select.set')->withoutMiddleware('classroom');
    Route::post('/guild-select/join-public', [Student\GuildSelectController::class, 'joinPublic'])->name('guild-select.join-public')->withoutMiddleware('classroom');

    // Notifications
    Route::post('/notifications/mark-read', [Student\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');

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
    Route::get('/quests/{quest}/quiz/review', [Student\QuizController::class, 'review'])->name('quizzes.review');

    // Profile & Inventory
    Route::get('/profile', [Student\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [Student\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}', [Student\ProfileController::class, 'showPublic'])->name('profile.public');

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

    // Classroom Management
    Route::resource('classrooms', Admin\ClassroomController::class);

    // Subject Management
    Route::resource('subjects', Admin\SubjectController::class)->except('show');

    // Quest Management
    Route::resource('quests', Admin\QuestController::class)->except('show');

    // Material Management
    Route::resource('materials', Admin\MaterialController::class)->except('show');

    // Quiz Management
    Route::resource('quizzes', Admin\QuizController::class)->except('show');

    // Badge Management
    Route::resource('badges', Admin\BadgeController::class);

    // Profile Management
    Route::get('/profile', [Admin\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update');

    // Player Dossier
    Route::get('/players/{user}', [Admin\PlayerReportController::class, 'show'])->name('players.show');
});
