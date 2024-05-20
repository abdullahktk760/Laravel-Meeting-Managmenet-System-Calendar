<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskValidation;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tasks = Task::with('user')->get();
        $user = User::all();

        return view('task.index', compact('tasks', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskValidation $request)
    {
        try {
            // Task::create($request->all());
            return redirect()->route('tasks.index')->withSuccess('Task created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('tasks.index')->withError('Task not created.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::with('user')->find($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskValidation $request, string $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($request->all());

            return redirect()->route('tasks.index')->withSuccess('Task updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->withError('Failed to update task: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('tasks.index')->withError('Task not found.');
        }

        try {
            $task->delete(); // Delete the task
            return redirect()->route('tasks.index')->withSuccess('Task deleted successfully.');
        } catch (\Exception $e) {

            return redirect()->route('tasks.index')->withError('Failed to delete task: ' . $e->getMessage());
        }
    }
}
