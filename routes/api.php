<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\partnersController;
use App\Http\Controllers\adminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// public Routes
    // user................
        Route::post('/register', [authController::class, 'register']);
        Route::post('/login', [authController::class, 'login']);
    //partner..............
        Route::post('/partner/register', [partnersController::class, 'register']);
        Route::post('/partner/login', [partnersController::class, 'login']);
    //Admin..................
        Route::post('/admin/register', [adminController::class, 'registerAdmin']); 
        Route::post('/admin/login', [adminController::class, 'loginAdmin']); 

    //*********************** */ Password Reset users***************************
        Route::post('forgot-password', [authController::class, 'forgotPassword']);
        Route::post('reset-password', [authController::class, 'reset']);

     //*********************** */ Password Reset users***************************
        Route::post('partner/forgot-password', [partnersController::class, 'forgotPassword']);
        Route::post('partner/reset-password', [partnersController::class, 'reset']);

    //*********************** */ products route*********************************  
        Route::get('products/all', [productsController::class, 'index']);
        Route::get('products/{productId}', [productsController::class, 'show']);
        Route::get('categoryfilter/{category}', [productsController::class, 'categoryFilter']);
        Route::post('pricefilter', [productsController::class, 'priceFilter']);
        Route::get('products/searchfilter/{product?}', [productsController::class, 'searchFilter']);

    //********************** */ Email verification ******************************
        Route::post('email/verification-notification', [authController::class, 'sendVerificationEmail'])->middleware('auth:sanctum')->name('verification.send');
        Route::get('verify-email/{id}/{hash}', [authController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

    //*********************** */ Email verification partners ******************************
        Route::post('partner/email/verification-notification', [partnersController::class, 'sendVerificationEmail'])->middleware('auth:partners')->name('verification.send');
        Route::get('partner/verify-email/{id}/{hash}', [partnersController::class, 'verify'])->name('verification.verify')->middleware('auth:partners');



// Protected Routes for users
    Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
        Route::get('/user', [authController::class, 'show']);
        Route::get('/logout', [authController::class, 'logout']);
        Route::post('/update', [authController::class, 'update']);
        // Route::get('/alluser', [authController::class, 'index']);
        Route::get('/delete', [authController::class, 'delete']);
    });


// Protected Routes for admins
    Route::group(['middleware' => ['auth:admins']], function(){
        Route::get('/admin/all', [adminController::class, 'indexAdmin']); 
        Route::post('/admin/update', [adminController::class, 'updateAdmin']); 
        Route::post('/admin/logout', [adminController::class, 'logoutAdmin']); 
        Route::post('/admin/delete', [adminController::class, 'deleteDelete']); 
        Route::get('/admin/show', [adminController::class, 'showAdmin']); 
        
    });

// Protected Routes for Partners
Route::group(['middleware' => ['auth:partners','verified']], function(){

        Route::get('/partner/allpartners', [partnersController::class, 'index']);
        Route::get('/partner/{id}', [partnersController::class, 'partnerProductOne']);

        Route::post('/productupdate/{products}', [productsController::class, 'updateProduct']);
        Route::get('/productdelete/{products}', [partnersController::class, 'destroyProduct']);
        Route::post('/updatediscount', [productsController::class, 'updateDiscount']);
        Route::post('/partner/update', [partnersController::class, 'updatePartner']);
        Route::post('/partner/delete', [partnersController::class, 'deletePartner']);
        
        Route::get('/partner/products', [partnersController::class, 'partnerProducts']);
        Route::post('products/create', [productsController::class, 'store']);
        Route::get('/partnerself', [partnersController::class, 'show']);
        Route::get('/partnerlogout', [productsController::class, 'partnerLogout']);

});






Route::get('/ip', function(){
    $serial = shell_exec('wmic bios get serialnumber');
    $pcname = shell_exec('hostname');
    $pcuser = shell_exec('whoami');
    var_dump( $_SERVER);

    return [$serial, $pcname, $pcuser];

});