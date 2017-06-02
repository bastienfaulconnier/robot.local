<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class LoginController extends Controller
{
	public function __construct() {
		view()->composer('partials.nav', function($view){    		
	    	$categories = DB::table('categories')->select('title', 'id')->get();  

	    	$current = request()->segment(1)  == 'cat' ? request()->segment(2) : (request()->path() == '/') ? 'home' : null;

	    	$view->with('current', $current);

	    	$view->with('categories', $categories);       
  		});
	}

	// l'objet $request il est injecter par le framework et représente la request client 
	public function login(Request $request){

		/*dd($request);*/

		/*if($request->isMethod('post')) {
			dd($request->email);
		}*/

		if($request->isMethod('post')){

			$this->validate($request, [
                'email' => 'bail|required|email',
                'password' => 'required|between:3,10',
                'remember' => 'in:remember' // dans le champ du checkbox value="remember"
            ], [
            'email.required' => 'email obligatoire',
            'email.email' => 'Syntax email non valide',
            'password.between' => 'le mot de passe doit être compris entre 8 à 10 caractères',
            'password.required' => 'le mot de passe est obligatoire'
            ]);

            // vérifions maintenant que l'utilisateur à les droit pour accèder à notre espace sécurité
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            	session()->flash('message', 'Bienvenue dans le dashboard !'); //enregistre une variable de session

                return redirect()->intended('dashboard'); // redirection propre au niveau de la sécurité
            }

            return back()->withInput(['email' => $request->email]);

		}

		return view('front.auth.login', []);
	}

	public function logout() {

        auth()->logout();
        session()->flash('message', 'Thanks so much for visit');
        return redirect()->home();
    }
}
