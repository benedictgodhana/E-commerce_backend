<?php

use App\Http\Controllers\RoleWithPermissions;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// routes/web.php

Route::get('/user/role', [UserController::class,'getRole']);
Route::get('/user/permissions', [UserController::class,'getPermissions']);
Route::get('/vendors/{id}', [VendorController::class, 'show']);
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->middleware('auth:sanctum');
Route::post('/request-email-verification', [EmailVerificationController::class, 'requestEmailVerification']);
Route::post('/verify-email', [EmailVerificationController::class, 'verifyEmail']);
Route::get('/products', [ProductController::class,'index']);
Route::get('/products/{id}', [ProductController::class,'show']);
Route::get('/session/cart/count', [CartController::class, 'countSessionCartItems']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [UserController::class,'getUser'])->middleware('auth:sanctum');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->middleware('auth:sanctum');
Route::get('/cart/items', [CartController::class, 'getCartItems'])->middleware('auth:sanctum');
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/register-vendor', [VendorController::class, 'register']);






Route::get('roles-with-permissions', [RoleWithPermissions::class,'getRolesWithPermissions']);
Route::post('/register', [RegistrationController::class,'register'])->name('register');

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
