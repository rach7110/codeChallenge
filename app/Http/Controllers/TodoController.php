<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Exception;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        $todos_json = [];

        foreach($todos as $todo) {
            $name = $todo->name;
            $completed = $todo->completed;
    
            $todos_json[] = [
                "task" => $name,
                "completed" => $completed
            ];

        }

        return json_encode($todos_json);
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
        $query = $request->all();
        
        if($query) {
            foreach($query as $input) {
                $json = json_decode($input);
    
                $todo = new Todo;
                $todo->name = $json->task;
                $todo->completed = $json->completed;
    
                if($todo->save()) {
                    return "Todo saved successfully!";
                } else {
                    throw new Exception("Problem saving your Todo. Please try again.");
                }
            }

        } else {
            throw new Exception("You entered incorrect json. Please try again.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);

        if($todo) {
            $name = $todo->name;
            $completed = $todo->completed;
    
            $todo_json = json_encode([
                "task" => $name,
                "completed" => $completed
            ]);
        } else {
            $todo_json = "Todo does not exists";
        }

        return $todo_json;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
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
    public function update(Request $request, $id)
    {
        $query = $request->all();

        if($query) {
            foreach($query as $input) {
                $json = json_decode($input);
    
                $todo = Todo::find($id);
                $todo->name = $json->task;
                $todo->completed = $json->completed;
    
                if($todo->save()) {
                    echo "Todo updated successfully! \n";
                    return $todo;
                } else {
                    throw new Exception("Problem saving your Todo. Please try again.");
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
