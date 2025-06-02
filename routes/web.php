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
        'nombre'  => 'required|string|max:255',
        'pape'    => 'required|string|max:255',
        'sape'    => 'required|string|max:255',
        'curp'    => 'required|string|size:18|regex:/^[A-Z]{4}\d{6}[HM][A-Z]{5}[0-9A-Z]\d$/',
        'tel'     => 'required|string|max:20',
        'email'   => 'required|email|max:255',
        'acceso'  => 'required|string|in:CNI,CINR',
    ]);

    registro::create([
        'ip' => $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'],
        'curp' => $request->curp,
        'acceso' => $request->acceso,
        'nombre' => $request->nombre,
        'pape' => $request->pape,
        'sape' => $request->sape,
        'tel' => $request->tel,
        'email' => $request->email,
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