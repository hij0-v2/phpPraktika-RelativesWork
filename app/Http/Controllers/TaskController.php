<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::with('user')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create(){
        $this->authorize('create', Task::class);

        return view('tasks.create');
    }

    public function store(Request $request){
        $this->authorize('create', Task::class);

        Task::create($request->only('description'));

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task){
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task){
        $this->authorize('update', $task);

        $task->update($request->only('description'));

        return redirect()->route('tasks.index');
    }

    public function completed($id){
        $task = Task::find($id);
        if ($task->completed){
            $task->update(['completed' => false]);
            return redirect()->back()->with('success', "Task is incomplete");
        }else{
            $task->update(['completed' => true]);
            return redirect()->back()->with('success', "Task is completed");
        }
    }

    public function destroy(Task $task){
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
