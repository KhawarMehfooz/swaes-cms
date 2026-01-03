<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect('/admin')
        : redirect('/admin/login');
});
