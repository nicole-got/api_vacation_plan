<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('holiday-plan', HolidayPlanController::class);

Route::get('holiday-plan/{id}/pdf', [HolidayPlanController::class, 'showPDF']);
