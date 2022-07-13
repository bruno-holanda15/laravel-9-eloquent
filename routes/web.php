<?php

use App\Models\Post;
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

Route::get('/where', function () {
    $name = request('name');
    $users = User::where('name', 'LIKE', "%{$name}%")
                    ->orWhere(function ($query) {
                        // $query->where('name', 'LIKE', '%De%');
                        $query->where('email' ,'gerda19@example.com');
                    })
                    ->get();

    dd($users);
});

Route::get('/orderby', function () {
    $users = User::orderby('name', 'DESC')->get();

    return $users;
});

Route::get('/insert', function () {
    $post = Post::create([
            'user_id' => 11,
            'title' => 'POst teste 2',
            'body' => 'Body do post 3',
            'date' => date('Y-m-d')
    ]);

    return $post;
});

Route::get('/delete', function () {
    $user = User::find(1);

    if ($user) {
        dd($user->delete());
    }
    // other option to delete more than one post
    // Post::destroy(Post::where('id', '<=2')->get());

    return 'User not found';
});