<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Robot;
use App\Tag; 
use App\Category;
use DB;

class FrontController extends Controller
{
	public function __construct() {
		view()->composer('partials.nav', function($view){    		
	    	$categories = DB::table('categories')->select('title', 'id')->get();  

	    	$current = request()->segment(1)  == 'cat' ? request()->segment(2) : (request()->path() == '/') ? 'home' : null;

	    	$view->with('current', $current);

	    	$view->with('categories', $categories);       
  		});
	}

    public function index(){

        $robots = Robot::with('tags', 'category')->published()->paginate(env('PAGINATION'));

        /*dump(app()->make('B'));*/

    	$robots = Robot::all(); // select * from robots;
    	$cats = Category::all();

    	return view('front.home', compact('robots','cats'));
    }

    public function showRobot(int $id, string $slug = ''){

		$robot = Robot::findOrFail($id);
      	$title = $robot->category ?  $robot->category->title : 'Page Robot';
      
        return view('front.single', compact('robot', 'title')); // ['robot'=> $robot, 'title' => $title];
    }

    public function showRobotByTag(int $id){
		$robots = Tag::findOrFail($id)->robots;
		$tagId = (int) $id;
    
        return view('front.tag', compact('robots', 'tagId'));
    }

    public function showRobotByCat($id){

        $category = Category::findOrFail($id);
		
        $robots = $category->robots()->with('tags', 'category')->paginate(env('PAGINATION'));
    
        return view('front.cat', compact('robots'));
    }
}
