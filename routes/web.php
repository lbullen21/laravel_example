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

Route::get('/', function () {
    return view('home.index');
}) ->name('home.index');

Route::get('/contact', function(){
    return view('home.contact');
}) ->name('home.contact');

Route::get('/posts/{id}', function($id){
    return 'Blog post ' . $id;
})->name('posts.show');

// ->where([
//     'id'=> '[0-9]+'
// ]) added this portion to RouteService in Providers so it will work on any id parameter

//this has default value of 20
Route::get('/recent-posts/{days_ago?}', function($daysAgo = 20){
    return 'Post created '. $daysAgo . ' ago';
})->name('posts.recent.index');
