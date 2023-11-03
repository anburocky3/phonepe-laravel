<?php


use Illuminate\Support\Facades\Route;

Route::get('/test/phonepe-test', function () {
    return view('phonepe::index');
})->name('test.phonepe-test');
