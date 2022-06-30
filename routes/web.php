<?php

use App\Models\User;
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
    return view('welcome');
});

Route::get('/select', function () {
    // $users = User::where('id', '<=', 10)->get(); traz uma coleção com o metodo get
    // $users = User::where('id', 10)->first(); traz o objeto de id 10
    // $user = User::first(); traz o primeiro usuário do banco
    // $user = User::find(32); procura o user com id 32
    // $user = User::findORFail(request('id'));

    $user = User::where('name', request('name'))->firstOrFail();

    dd($user);
});