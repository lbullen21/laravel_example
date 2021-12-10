<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
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

// Route::get('/', function () {
//     return view('home.index');
// }) ->name('home.index');

// Route::get('/contact', function(){
//     return view('home.contact');
// }) ->name('home.contact');

//these are the refactored versions of above
Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');


$posts = [
    1 => [
         'title' => 'Intro to Laravel',
         'content' => 'This is a short intro to Laravel',
         'is_new' => true
     ],
     2 => [
         'title' => 'Intro to PHP',
         'content' => 'This is a short intro to PHP',
         'is_new' => false
     ]
];

Route::resource('posts', PostsController::class)
    ->only(['index', 'show', 'create', 'store']);

// Route::get('/posts', function() use($posts){
//     return view('posts.index', ['posts' => $posts]);
// });

// Route::get('/posts/{id}', function($id) use($posts){
    
//     abort_if(!isset($posts[$id]), 404);
//     return view('posts.show', ['post' => $posts[$id]]);
// })->name('posts.show');

// ->where([
//     'id'=> '[0-9]+'
// ]) added this portion to RouteService in Providers so it will work on any id parameter

//this has default value of 20
Route::get('/recent-posts/{days_ago?}', function($daysAgo = 20){
    return 'Post created '. $daysAgo . ' ago';
})->name('posts.recent.index');

//can add prefix function so you don't have to repeat code as much

Route::prefix('/fun')->name('fun.')->group(function() use($posts){

  Route::get('/responses', function() use($posts){
      return response($posts, 201)
      ->header('Content-Type', 'applications/json')
      ->cookie('MY_COOKIE', 'Lauren Bullen', 3600);
  })->name('responses');
  
  Route::get('/redirect', function(){
      return redirect('/contact');
  })->name('redirect');
  
  Route::get('/back', function(){
      return back();
  })->name('back');
  
  Route::get('/json', function() use($posts){
      return response()->json($posts);
  })->name('json');
  
  Route::get('/download', function() use($posts){
      return response()->download(public_path('/daniel.jpg',), 'face.jpg');
  })->name('download');

});