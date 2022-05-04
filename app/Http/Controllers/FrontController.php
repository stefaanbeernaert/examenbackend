<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('layouts.login',compact('tasks'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!Auth::user()){
            Session::flash('task','Please Login Or Register to add Task');
            return redirect()->to(url()->previous());
        }
        $task = New Task();
        $task->task = $request->task;
        $task->user_id = Auth::user()->id;
        $task->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if (Auth::user()){
            foreach (Auth::user()->roles as $role){
                if (Auth::user()->id == $task->user_id){
                    $task->delete();
                    return redirect('home');
                }elseif ($role->name == "admin"){
                    $task->delete();
                    return redirect('home');
                }else{
                    return redirect('home');
                }

            }

        }

        return redirect('home');


    }
}
