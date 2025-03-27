<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBooksController;
use App\Http\Controllers\AdminBorrowingController;
use App\Http\Controllers\AdminReturnController;
use App\Http\Controllers\AdminGenresController;
use App\Http\Controllers\AdminAdminsController;
use Illuminate\Auth\Events\Registered;

// 未ログイン・ログインどちらでもアクセス可能なトップページ
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔹 ログインユーザー向けのページ
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/books', [BooksController::class, 'search'])->name('user.books.search');
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('user.mypage.current');
});

// 🔹 ユーザー登録
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// 🔹 ログイン・ログアウト
Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🔹 本の検索・詳細
Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/books/details/{id}', [BooksController::class, 'details'])->name('books.details');

// 🔹 マイページ関連
Route::middleware('auth')->group(function () {
    Route::get('/mypage/current', [MypageController::class, 'current'])->name('mypage.current');
    Route::get('/mypage/borrowed', [MypageController::class, 'borrowed'])->name('mypage.borrowed');
});

// 🔹 管理者ダッシュボード
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// 🔹 ユーザーのプロフィール管理
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 管理者向けのルート
Route::prefix('admin')->name('admin.')->group(function () {
    // 管理者ログイン・ログアウト
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        // 🔹 ダッシュボード
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // 🔹 ユーザー管理
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/details/{id}', [AdminUserController::class, 'details'])->name('users.details');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // ユーザーの貸出履歴
        Route::get('/users/{id}/history', [AdminUserController::class, 'history'])->name('users.history');
        

        // 🔹 書籍管理
        Route::get('/books', [AdminBooksController::class, 'index'])->name('books.index');
        Route::get('/books/add', [AdminBooksController::class, 'create'])->name('books.add');
        Route::post('/books/store', [AdminBooksController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/details', [AdminBooksController::class, 'show'])->name('books.details');
        Route::get('/books/{book}/edit', [AdminBooksController::class, 'edit'])->name('books.edit');
        Route::patch('/books/{book}', [AdminBooksController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [AdminBooksController::class, 'destroy'])->name('books.destroy');

        // 🔹 書籍一括登録
        Route::get('/books/import', [AdminBooksController::class, 'importView'])->name('books.import');
        Route::post('/books/import', [AdminBooksController::class, 'import'])->name('books.import');

        // 🔹 貸出処理
        Route::prefix('borrowing')->name('borrowing.')->group(function () {
            Route::get('/', [AdminBorrowingController::class, 'index'])->name('index');
            Route::get('/select', [AdminBorrowingController::class, 'select'])->name('select');
            Route::post('/select', [AdminBorrowingController::class, 'select'])->name('select');
            Route::get('/selectMember', [AdminBorrowingController::class, 'selectMember'])->name('selectMember');
            Route::post('/selectMember', [AdminBorrowingController::class, 'selectMember'])->name('selectMember');
            Route::get('/addBook/{book_id}', [AdminBorrowingController::class, 'addBook'])->name('addBook');
            Route::post('/addBook/{book_id}', [AdminBorrowingController::class, 'addBook'])->name('addBook');
            Route::get('/removeBook/{book_id}', [AdminBorrowingController::class, 'removeBook'])->name('removeBook');
            Route::post('/removeBook/{book_id}', [AdminBorrowingController::class, 'removeBook'])->name('removeBook');
            Route::get('/list', [AdminBorrowingController::class, 'list'])->name('list');
            Route::post('/list', [AdminBorrowingController::class, 'list'])->name('list');
            Route::get('/confirm', [AdminBorrowingController::class, 'confirm'])->name('confirm');
            Route::post('/confirm', [AdminBorrowingController::class, 'confirm'])->name('confirm');
            Route::get('/complete', [AdminBorrowingController::class, 'showComplete'])->name('complete');
            Route::post('/complete', [AdminBorrowingController::class, 'showComplete'])->name('complete');
        });

        // 🔹 返却処理
        Route::prefix('return')->name('return.')->group(function () {
            Route::get('/', [AdminReturnController::class, 'index'])->name('index');
            Route::post('/confirm', [AdminReturnController::class, 'confirm'])->name('confirm');
            Route::post('/update-due-date', [AdminReturnController::class, 'updateDueDate'])->name('updateDueDate');
            Route::get('/complete', function () {
                return view('admin.return.confirm'); // ここで GET を許可
            })->name('complete');
        });

        // 🔹 ジャンル管理
        Route::get('/genres', [AdminGenresController::class, 'index'])->name('genres.index');

        // 🔹 管理者管理
        Route::prefix('admins')->name('admins.')->group(function () {
            Route::get('/', [AdminAdminsController::class, 'index'])->name('index');
            Route::get('/create', [AdminAdminsController::class, 'create'])->name('create');
            Route::post('/', [AdminAdminsController::class, 'store'])->name('store');
            Route::get('/{admin}/edit', [AdminAdminsController::class, 'edit'])->name('edit');
            Route::put('/{admin}', [AdminAdminsController::class, 'update'])->name('update');
            Route::delete('/{admin}', [AdminAdminsController::class, 'destroy'])->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';
