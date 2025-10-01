<?php

use App\Http\Controllers\CarburantMissionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PointsFinMissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequeteAjaxController;
use App\Http\Controllers\TypeCarburantController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class,"indexPage"])->name("indexPage");
// Route::get('/vehicules', [FrontendController::class,"indexVehicule"])->name("indexVehicule");
// Route::get('/vehicules/create', [FrontendController::class,"createVehicule"])->name("createVehicule");

// Route::post('/vehicules/store', [FrontendController::class,"storeVehicule"])->name("vehicules.store");

// Route::get('/missions/home', [FrontendController::class,"homeMission"])->name("homeMission");
// Route::get('/missions/create', [FrontendController::class,"createMission"])->name("createMission");
// Route::get('/missions/carburant-mission', [FrontendController::class,"remiseCarburantMissionPage"])->name("remiseCarburantMissionPage");
// Route::get('/missions/fin-mission', [FrontendController::class,"enregistrerFinMissionPage"])->name("enregistrerFinMissionPage");
Route::get('/dashboard-index', [FrontendController::class,"indexDashboard"])->name("indexDashboard");
Route::get('/dashboard-carburant', [FrontendController::class,"DashboardCarburant"])->name("DashboardCarburant");

// Véhicules
Route::resource('vehicules', VehiculeController::class)->except(['show','destroy']);


// Missions
Route::resource('missions', MissionController::class)->except(['show','destroy']);
Route::resource('carburants', CarburantMissionController::class)->except(['show','destroy']);

// Points de fin de mission
Route::get('pointsfin/create', [PointsFinMissionController::class, 'create'])->name('pointsfin.create');
Route::post('pointsfin', [PointsFinMissionController::class, 'store'])->name('pointsfin.store');


// Types de carburants
Route::get('typecarburants/create', [TypeCarburantController::class, 'create'])->name('typecarburants.create');
Route::post('typecarburants', [TypeCarburantController::class, 'store'])->name('typecarburants.store');

Route::post('/ajax/supprimer-remise-carburant', [RequeteAjaxController::class, 'supprimerRemiseCarburant'])->name('supprimerRemiseCarburant');
Route::get('/ajax/get-last-mission-vehicule', [RequeteAjaxController::class, 'getLastMissionVehicule'])->name('getLastMissionVehicule');

Route::post("/ajax/marquer-mission-terminee",[RequeteAjaxController::class,"terminerMission"])->name("terminerMission");
Route::post("/ajax/restaurer-mission",[RequeteAjaxController::class,"restaurerMission"])->name("restaurerMission");
Route::post("/ajax/supprimer-mission",[RequeteAjaxController::class,"supprimerMission"])->name("supprimerMission");

require __DIR__.'/auth.php';
