<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PermissionsController;
use App\Http\Controllers\API\PriceController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RemittanceController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\SaleCrontroller;
use App\Http\Controllers\API\SpreadsheetController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\DiscountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sales', [SaleCrontroller::class, 'index']);
Route::post('sales/filter', [SaleCrontroller::class, 'filter']);

Route::get('products', [ProductController::class, 'index']);
Route::post('products/filter', [ProductController::class, 'filter']);

Route::post('/users/login', [AuthController::class, 'login']);
Route::get('/vehicles/inactive', [VehicleController::class, 'inactive']);

Route::get('discounts', [DiscountController::class, 'index']);
Route::post('discounts', [DiscountController::class, 'store']);
Route::get('discounts/{id}', [DiscountController::class, 'show']);
Route::put('discounts/{id}', [DiscountController::class, 'update']);
Route::delete('discounts/{id}', [DiscountController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicles/{id}', [VehicleController::class, 'show']);
    Route::post('/vehicles', [VehicleController::class, 'store']);
    Route::put('/vehicles/{id}', [VehicleController::class, 'update']);
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy']);
    Route::post('/vehicles/filter', [VehicleController::class, 'filter']);

    Route::get('users', [AuthController::class, 'index']);
    Route::put('/users/{id}', [AuthController::class, 'update']);
    Route::delete('/users/{id}', [AuthController::class, 'destroy']);
    Route::post('/users/register', [AuthController::class, 'store']);
    Route::get('/users/logout', [AuthController::class, 'logout']);

    Route::get('prices', [PriceController::class, 'index']);
    Route::get('/prices/{id}', [PriceController::class, 'show']);
    Route::post('/prices', [PriceController::class, 'store']);
    Route::put('/prices/{id}', [PriceController::class, 'update']);
    Route::delete('/prices/{id}', [PriceController::class, 'destroy']);

    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
    Route::post('/customers/filter', [CustomerController::class, 'filter']);

    Route::get('tickets', [TicketController::class, 'index']);
    Route::get('/tickets/{id}', [TicketController::class, 'show']);
    Route::post('/tickets/filter', [TicketController::class, 'filter']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::put('/tickets/{id}', [TicketController::class, 'update']);
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy']);

    Route::get('drivers', [DriverController::class, 'index']);
    Route::get('/drivers/{id}', [DriverController::class, 'show']);
    Route::post('/drivers', [DriverController::class, 'store']);
    Route::put('/drivers/{id}', [DriverController::class, 'update']);
    Route::delete('/drivers/{id}', [DriverController::class, 'destroy']);
    Route::post('/drivers/filter', [DriverController::class, 'filter']);

    Route::get('spreadsheets', [SpreadsheetController::class, 'index']);
    Route::get('/spreadsheets/{id}', [SpreadsheetController::class, 'show']);
    Route::post('/spreadsheets', [SpreadsheetController::class, 'store']);
    Route::put('/spreadsheets/{id}', [SpreadsheetController::class, 'update']);
    Route::delete('/spreadsheets/{id}', [SpreadsheetController::class, 'destroy']);
    Route::post('/spreadsheets/filter', [SpreadsheetController::class, 'filter']);

    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('/payments/{id}', [PaymentController::class, 'show']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::put('/payments/{id}', [PaymentController::class, 'update']);
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);
    Route::post('/payments/filter', [PaymentController::class, 'filter']);

    Route::get('reviews', [ReviewController::class, 'index']);
    Route::get('/reviews/{id}', [ReviewController::class, 'show']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
    Route::post('/reviews/filter', [ReviewController::class, 'filter']);

    Route::get('remittances', [RemittanceController::class, 'index']);
    Route::get('/remittances/{id}', [RemittanceController::class, 'show']);
    Route::post('/remittances', [RemittanceController::class, 'store']);
    Route::put('/remittances/{id}', [RemittanceController::class, 'update']);
    Route::delete('/remittances/{id}', [RemittanceController::class, 'destroy']);
    Route::post('/remittances/filter', [RemittanceController::class, 'filter']);

    Route::get('permissions', [PermissionsController::class, 'index']);
    Route::get('/permissions/{id}', [PermissionsController::class, 'show']);
    Route::post('/permissions', [PermissionsController::class, 'store']);
    Route::put('/permissions/{id}', [PermissionsController::class, 'update']);
    Route::delete('/permissions/{id}', [PermissionsController::class, 'destroy']);
});
