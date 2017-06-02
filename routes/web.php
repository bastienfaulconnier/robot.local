<?php

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

/*Route::get('/{name}', function ($name) {
    //return view('welcome');
    return "Hello Laravel ! Je suis $name !!";
});

Route::get('/category/{id}/{slug?}', function ($id, $slug = '') {

	$slug = empty($slug)? 'no slug' : $slug;

    return "Je suis le robot n°$id, slug: $slug";
});*/

Route::get('/robot/{id}/{slug?}', 'FrontController@showRobot');  
Route::get('/tag/{id}', 'FrontController@showRobotByTag');  
Route::get('/category/{id}', 'FrontController@showRobotByCat');
Route::get('/', 'FrontController@index')->name('home'); // route('home') // construit l'url  

//Route::get('/login', 'Admin\LoginController@login');
//Route::post('auth/login', 'Admin\LoginController@login');
Route::any('login', 'Admin\LoginController@login')->name('login');
Route::get('logout', 'Admin\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){
	Route::get('dashboard', 'Admin\DashboardController@index');
    Route::resource('admin/robot', 'Admin\RobotController'); 
});

class A{}

class B{

	public function __construct(A $a){
    
    	$this->a = $a;
    
    }

    public function message(){
    	return "Hello world";
    }

}

/*dump( (new B (new A) ) ) ;

dump( app()->make('B') ) ;*/