<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RobotRequest;
use App\Robot;
use App\Tag; 
use App\Category;
use DB;
use Illuminate\Support\Facades\Gate;

class RobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $robots = Robot::paginate(5);

        return view('back.robot.robot', compact('robots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $this->authorize('create', Robot::class);

        $categories = Category::pluck('title', 'id');
        $tags = Tag::pluck('name', 'id');
        
        /*dd($categories);*/
        
        return view('back.robot.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RobotRequest $request)
    {
        /*dd($request->all());*/

        /*$this->validate($request, [
            'name' => 'bail|required|string',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories:id', // robot non catégorisé => value="" ou catégorisé et dans ce cas on vérifie que la ressource est bien en base de données
            'tags.*' => 'exists:tags:id',
            'status' => 'bail|required|in:published,unpublished'
        ]);*/

        //dd($request->link);

        
            

        $robot = Robot::create($request->all());
        /*$robot->slug = str_slug($request->name); 
        $robot->published_at = $request->status? Carbon\Carbon::now() : null;
        $robot->save();*/

        $robot->tags()->attach($request->tags);

        if($request->hasFile('link')){
            // dd($request->link);

            $file = $request->link;
            $ext = $request->link->extension();
            $filename = str_random(12) . '.' . $ext;

            $robot->link = $filename;

            $request->link->storeAs('images', $filename);
            $robot->save();

        }

        return redirect()->route('robot.create')->with('message', sprintf('merci pour votre insertion du robot %s', $robot->name));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        $robot = Robot::findorfail($id);

        $categories = Category::pluck('title', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('back.robot.edit', compact('robot', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Robot $robot)
    {

        $this->authorize('update', Robot::class);

       /* $robot = Robot::find($id);  // fonctionne avec $id passé en paramètre mais le mieux c'est d'injecter l'entité dans update voir au-dessus*/
        $robot->update($request->all());

        $robot->tags()->sync($request->tags);

        return redirect()->route('robot.index')->with('message', sprintf('merci pour votre insertion du robot %s effectué avec succès', $robot->name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Robot $robot)
    {

        if (!Gate::allows('destroy', $robot)) {
            abort(403, 'Unauthorized action.');
        }   

        $name = $robot->name;
        $robot->delete();

        return redirect()->route('robot.index')->with('message', sprintf('hop %s supprimé', $robot->name));
    }
}
