<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Task::orderBy("created_at", "asc")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request): Task
    {
        $this->validate($request, [ //inputs are not empty or null
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = new Task;
        $task->title = $request->input('title'); //retrieving user inputs
        $task->description = $request->input('description');  //retrieving user inputs
        $task->save(); //storing values as an object
        return $task; //returns the stored value if the operation was successful.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(int $id)
    {
        return Task::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): Task
    {
        $this->validate($request, [ // the new values should not be null
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::findorFail($id); // uses the id to search values that need to be updated.
        $task->title = $request->input('title'); //retrieves user input
        $task->description = $request->input('description');////retrieves user input
        $task->save();//saves the values in the database. The existing data is overwritten.
        return $task; // retrieves the updated object from the database
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $task = Task::findorFail($id); //searching for object in database using ID
        if($task->delete()){ //deletes the object
            return 'deleted successfully'; //shows a message when the delete operation was successful.
        }
    }
}
