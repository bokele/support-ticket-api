<?php

use App\Http\Controllers\Api\V1\TicketApiController;
use App\Http\Controllers\Api\V1\AuthorsApiController;
use App\Http\Controllers\Api\V1\AuthorTicketsApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\AuthApiController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// http://localhost:8000/api/
// univseral resource locator
// tickets
// users

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', TicketApiController::class)->except(['update']);
    Route::put('tickets/{ticket}', [TicketApiController::class, 'replace']);
    Route::patch('tickets/{ticket}', [TicketApiController::class, 'update']);

    Route::apiResource('users', UserApiController::class)->except(['update']);
    Route::put('users/{user}', [UserApiController::class, 'replace']);
    Route::patch('users/{user}', [UserApiController::class, 'update']);

    Route::apiResource('authors', AuthorsApiController::class)->except(['store', 'update', 'delete']);
    Route::apiResource('authors.tickets', AuthorTicketsApiController::class)->except(['update']);
    Route::put('authors/{author}/tickets/{ticket}', [AuthorTicketsApiController::class, 'replace']);
    Route::patch('authors/{author}/tickets/{ticket}', [AuthorTicketsApiController::class, 'update']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});