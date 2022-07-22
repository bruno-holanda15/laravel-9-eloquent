<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    // $user = User::findOrFail(request('id'));
    // $posts = Post::all(); Retorn todos os posts do banco

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
            'user_id' => 10,
            'title' => 'POst teste 10',
            'body' => 'Body do post 10',
            'date' => date('Y-m-d')
    ]);

    return $post;
});

Route::get('/update', function () {
    // update utilizando o method save
    // $post = Post::findOrFail(1);
    // $post->title = 'Oloquinho meu';
    // $post->save();

    $post = Post::findOrFail(3);
    $post->update([
        'title' => 'Oloquinho eleven',
        'body' => 'Inazuma eleven é top'
    ]);

    return $post->all();
});

Route::get('/delete', function () {
    $user = User::findOrFail(12);

    return $user->delete();
    // other option to delete more than one post
    // Post::destroy(Post::where('id', '2')->get());
});

Route::get('/softDelete', function () {
    //other option to delete more than one post
    Post::destroy(Post::where('id', '<=', '2')->get());

    return Post::all();
});

Route::get('/postTitle', function () {
    $post = Post::findOrFail(request('post'));

    return $post->title;
});

Route::get('/postTitleAndBody', function () {
    $post = Post::findOrFail(request('post'));

    return $post->title_and_body;
});

Route::get('/mutator', function () {
    $user = User::first();
    $post = Post::create([
        'user_id' => $user->id,
        'title' => 'Post ' . Str::random(5),
        'body' => 'Body ' . Str::random(15),
        'date' => now()
    ]);

    return $post;
});