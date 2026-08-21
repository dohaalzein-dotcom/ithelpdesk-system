<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketAttachmentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', function () {
    try {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json($user);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Token is invalid or missing',
            'error' => $e->getMessage(),
        ], 401);
    }
});
Route::middleware(['auth:api', 'role:2'])->get('/admin-test', function () {
    return response()->json([
        'message' => 'Welcome Admin!'
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('roles', RoleController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('priorities', PriorityController::class);
Route::apiResource('statuses', StatusController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('ticketcomments', TicketCommentController::class);
Route::apiResource('ticketattachments', TicketAttachmentController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('activitylogs', ActivityLogController::class);