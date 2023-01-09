<?php

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

Route::view('/', 'home.index')->name('home.index');
Route::view('/contact', 'home.contact')->name('home.contact');

$posts = [
    1 => [
        'is_new' => false,
        'has_comments' => true,
        'title' => 'Post about Laravel Migrations',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias veniam expedita vero blanditiis, fuga, sed ratione libero tempore ad beatae inventore, quos iste est similique accusamus ea molestias dolorem labore.'
    ],
    2 => [
        'is_new' => true,
        'title' => 'Post about Apache start on MacOS',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias veniam expedita vero blanditiis, fuga, sed ratione libero tempore ad beatae inventore, quos iste est similique accusamus ea molestias dolorem labore.'
    ],
    3 => [
        'is_new' => false,
        'has_comments' => true,
        'title' => 'Post about Laravel Routes',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias veniam expedita vero blanditiis, fuga, sed ratione libero tempore ad beatae inventore, quos iste est similique accusamus ea molestias dolorem labore.'
    ],
];

Route::get('/posts/{id}', function ($id) use($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('post.show', ['id' => $id, 'post' => $posts[$id]]);
})->where(['id' => '[0-9]+'])->name('posts.show');

Route::get('/posts', function () use($posts) {
    return view('post.index', ['posts' => $posts]);
})->name('posts.index');


Route::get('/posts-recent/{date?}', function ($date = '01-01-2022') {
    return view('post.recent-list', ['date' => $date]);
})->name('posts.recent');
