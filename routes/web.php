<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Profile;
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
   $comment =new Comment();
   $comment->body='nice post';
    $post=Post::find(1);
    $post->comments()->save($comment);
    foreach($post->comments as $comment){
        echo $comment->body;
    }
});
/* $user=User::find(1);
    //$user->roles()->sync(2);
    foreach($user->roles as $role){
        echo $role->role;
    }//////////
    $user=User::find(1);
    echo $user->profile->address;
    $profile=Profile::find(2);
    echo $profile->user->name;*/
/*
 return view('welcome); 
 Route::get('/auth', function () {   
    return view('auth');
});*/

