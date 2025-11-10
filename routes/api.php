<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\FotoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Debug routes for troubleshooting
Route::get('/debug/galery', function () {
    $galeries = \App\Models\Galery::all();
    return response()->json([
        'success' => true,
        'count' => $galeries->count(),
        'data' => $galeries
    ]);
});

Route::get('/debug/foto', function () {
    $fotos = \App\Models\Foto::all();
    return response()->json([
        'success' => true,
        'count' => $fotos->count(),
        'data' => $fotos
    ]);
});

Route::get('/debug/petugas', function () {
    $petugas = \App\Models\Petugas::all();
    return response()->json([
        'success' => true,
        'count' => $petugas->count(),
        'data' => $petugas
    ]);
});

// Debug route untuk test model binding
Route::get('/debug/petugas/{id}', function ($id) {
    try {
        $petugas = \App\Models\Petugas::find($id);
        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Petugas not found',
                'id_requested' => $id
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $petugas
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});

// Simple test route for foto creation
Route::post('/test-foto', function (Request $request) {
    try {
        // Simple validation
        if (!$request->galery_id || !$request->file || !$request->judul) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields',
                'received' => $request->all()
            ], 400);
        }

        // Create foto directly
        $foto = \App\Models\Foto::create([
            'galery_id' => $request->galery_id,
            'file' => $request->file,
            'judul' => $request->judul
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto created via test route',
            'data' => $foto
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// Kategori Routes
Route::apiResource('kategoris', KategoriController::class);

// Petugas Routes
Route::apiResource('petugas', PetugasController::class);

// Posts Routes
Route::apiResource('posts', PostController::class);

// Profile Routes
Route::apiResource('profiles', ProfileController::class);

// Galery Routes
Route::apiResource('galeries', GaleryController::class);

// Foto Routes
Route::apiResource('fotos', FotoController::class);
