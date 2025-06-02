<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\registro;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/registrar-acceso', function (Request $request) {
    $request->validate([
        'curp' => 'required|string',
        'acceso' => 'required|string|in:CNI,CINR',
    ]);

    registro::create([
        'ip' => $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'],
        'curp' => $request->curp,
        'acceso' => $request->acceso,
    ]);

    return response()->json(['success' => true]);
});

Route::get('/debug-ip', function () {
    return response()->json([
        'Laravel IP' => request()->ip(),
        '_SERVER["HTTP_X_FORWARDED_FOR"]' => $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'not set',
        '_SERVER["REMOTE_ADDR"]' => $_SERVER['REMOTE_ADDR'] ?? 'not set',
        'headers' => request()->headers->all(),
    ]);
});