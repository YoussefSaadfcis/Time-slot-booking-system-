<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ScheduleController;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ServiceController::class, 'index'])->name("service.index");

//Schedule routes
Route::get("schedule", [ScheduleController::class, "index"])->name("schedule.index");
Route::get("schedule/add", [ScheduleController::class, "create"])->name("schedule.create");
Route::post("schedule/add", [ScheduleController::class, "import"])->name("schedule.import");
Route::delete("schedule/{id}", [ScheduleController::class, "destroy"])->name("schedule.destroy");
//branches routes
Route::get("/branches", [BranchesController::class, 'index'])->name("branches.index");
Route::get("branches/add", [BranchesController::class, 'create'])->name("branches.create");
Route::post("branches/add", [BranchesController::class, 'store'])->name("branches.store");
Route::get("branches/{id}", [BranchesController::class, 'edit'])->name("branches.edit");
Route::put("branches/{id}", [BranchesController::class, 'update'])->name("branches.update");
Route::delete("branches/{id}", [BranchesController::class, 'destroy'])->name("branches.destroy");


//service routes

Route::get("service/add", [serviceController::class, 'create'])->name("service.create");
Route::post("service/add", [serviceController::class, 'store'])->name("service.store");
Route::get("service/{id}", [serviceController::class, 'edit'])->name("service.edit");
Route::put("service/{id}", [serviceController::class, 'update'])->name("service.update");
Route::delete("service/{id}", [serviceController::class, 'destroy'])->name("service.destroy");




// Route::get("testpass",function(){
//     return Hash::make("123123123");
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
