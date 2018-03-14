<?php

use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;

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

/*Route::get('/', function () {
    return view('welcome');
});

*/
/*
Route::get('admin/posts/example', array( 'as'=>'admin.home' ,function(){

    $url = route('admin.home');

    //<a href="route('admin.home')" >Entrar na pagina</a>

    return "this url is ".$url;

}));

Route::get('/about', function(){
    return "Hi about home page";
});

Route::get('/contact', function(){
    return "Hi I am contact";
});

Route::get('/post/{id}', function($id){

    return "this is post number ".$id;

});

Route::get('/post/{id}', function($id){

    return "this is post number ".$id;

});

Route::get('/post/{id}/{name}', function($id, $name){

    return "this is post number ".$id." ".$name;

});

*/

//Route::get('/post/{id}', 'PostController@index');

//Route::resource('posts', 'PostController');

//Route::get('/contact', 'PostController@contact');

//Route::get('post/{id}/{name}/{password}', 'PostController@show_post');


/*
Route::get('/insert', function(){
    DB::insert('insert into posts (title, body) VALUES (?,?)',['PHP with Laravel','it is a cool framework wdfsdf']);
});

Route::get('/read', function(){
   $results = DB::select('select * from posts where id = ?',[1]);

   foreach ($results as $post){
       return $post->title;
   }


 return $results;
});

*/
/*
Route::get('/update', function(){
    $updated = DB::update('update posts set title ="Titulo atualizado" where id = ? ', [1]);
    return $updated;
});

Route::get('/delete', function(){
   $deleted = DB::delete('delete from posts where id = ?',[1]);
   return $deleted;
});
*/

//  ELOQUENT

Route::get('/find', function(){
  // $posts = App\Post;
    $post = Post::find(2);

    return $post->title;

});

Route::get('/findwhere', function(){
    $post = Post::where('id', 1)->orderBy('id','desc')->take(1)->get();

    return $post[0]->title;

});

Route::get('/findmore', function(){
   $post = Post::findOrFail(2);
   return $post;

   //exemplo
   // $post = Post::where('users_count', '<', 50)->firstOrFail();

});

Route::get('/basicinsert', function(){
    $post = new Post;

    $post->title = 'New ORM title';
    $post->body  = 'We are testing the new insert';

    $post->save();
});


Route::get('/basicupdate', function(){
    $post = Post::find(3);

    $post->title = 'Laravel Atualizando';
    $post->body  = 'Estamos atiualizando a nossa tabela';

    $post->save();
});

Route::get('/create', function(){

    Post::create(['title'=>'Creating a title php ds', 'body'=>'testefasdfasfdssss']);

});

Route::get('/update', function(){
    Post::where('id',2)->where('is_admin',1)->update(['title'=>'New PHP Title', 'body'=>'I love My Instructor']);
});

Route::get('/delete', function(){
    $post = Post::find(1);

    $post->delete();
});

Route::get('/delete2', function(){
    Post::destroy([4,5]);

    Post::where('is_admin',0)->delete();
});

Route::get('/softdelete', function(){
    Post::find(5)->delete();
});

Route::get('/readsoftdelete', function(){
    $post = Post::onlyTrashed()->where('id', 4)->get();
    return $post;
});

Route::get('/restore', function(){
    Post::withTrashed()->where('is_admin',0)->restore();
});

Route::get('/forcedelete', function(){
    Post::withTrashed()->where('is_admin',0)->forceDelete();
});

//==================== Eloquent Relationships ==================

// One to One
Route::get('/user/{id}/post', function($id){
    return User::find(1)->post->body;
});

Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});

//One to many
Route::get('/posts', function(){
    $user = User::find(1);

    foreach($user->posts as $post){
        echo $post->title."<br/>";
    }
});

Route::get('/user/{id}/role', function($id){
   $user = User::find($id)->roles()->orderBy('id','desc')->get();

   return $user;
   /*foreach($user->roles as $role){
       echo $role->name;
   }*/

});

// acessando a tabela intermediante

Route::get('/user/pivot', function(){
    $user = User::find(1);

    foreach ($user->roles as $role){
        echo $role->pivot->created_at;
    }
});

Route::get('/user/country', function(){

});