<?php

use App\Http\Controllers\AlbumController;
use App\Models\Album;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $albums = Album::all();
    // dd($albums[0]->photos->img_src);
    return view('home', compact('albums'));
});

Route::resource("album", AlbumController::class);