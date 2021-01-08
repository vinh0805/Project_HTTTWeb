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

Route::get('/login', 'LoginController@login');
Route::post('/login-confirm', 'LoginController@loginConfirm');
Route::get('/logout', 'LoginController@logout');
Route::get('/signup', 'LoginController@signup');
Route::get('/signup/success', 'UserController@signupSuccess');

Route::get('/', 'PostController@showPostsHomePage');
Route::get('/home', 'PostController@showPostsHomePage');

// User
Route::post('/signup-submit', 'UserController@createNewUser');
Route::get('/me', 'UserController@showProfile');
Route::post('/update-profile/{userId}', 'UserController@updateProfile');
Route::get('/user/{userId}/info', 'UserController@showUserInfo');

Route::get('/me/password', 'UserController@changePassword');
Route::post('/update-password/{userId}', 'UserController@updatePassword');

// Category
Route::get('/pets-category/{categoryPetName}/{categoryName}', 'CategoryController@showPostOfCategoryPet');

// Post
Route::get('/post/create', 'PostController@createPost');
Route::post('/post/save', 'PostController@savePost')->name('ckeditor.upload');
Route::get('/post/{postId}', 'PostController@showPost');

// Review post
Route::get('requests/post/list', 'PostController@showRequestPostList');
Route::post('review-post/{postId}', 'PostController@reviewPost');

// Comment
Route::post('/post/{postId}/write-comment', 'CommentController@writeComment');

// Search
Route::get('/search', 'PostController@search');

// Test function
Route::get('/test', 'PostController@findHotPosts');
