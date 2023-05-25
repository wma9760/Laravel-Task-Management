<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends NotificationController
{
    public function index()
    {
        $tasks = Task::with('project')->get();
        return view('dashboard.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::where('status', 'pending')->get();
        // $users=User::where
        return view('dashboard.tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required',
            'priority' => 'required',
            'project_id' => 'required'
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->project_id = $request->project_id;
        $task->priority = $request->priority;
        $task->status = 'pending';
        $task->description = $request->description;
        $task->creater_id = Auth::user()->id;
        $task->save();

        $this->sendNotification('Task created',$task->name.'has been created successfully');


        return redirect()->route('task.index')
            ->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $Task = Task::find($id);
        return redirect()->route('task.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        $projects = Project::where('status', 'pending')->get();
        return view('dashboard.tasks.update', compact('task', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->name = $request->name;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->project_id = $request->project_id;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->update();
        $this->sendNotification('Task updated',$task->name.'has been updated successfully');

        return redirect()->route('task.index')
            ->with('success', 'Task created successfully.');
    }

    public function destroy($id)
    {
        $Task = Task::find($id);
        $Task->delete();
        $this->sendNotification('Task deleted',$Task->name.'has been deleted successfully');

        return redirect()->route('task.index')
            ->with('success', 'Task created successfully.');
    }
    public function projectMembers(Request $req)
    {
        $id = $req->id;

        $users = User::whereHas('teams', function ($query) use ($id) {
            $query->whereHas('team', function ($query) use ($id) {
                $query->where('project_id', $id);
            });
        })->get();
        return response()->json($users);
    }
    public function TaskCompleted($id)
    {

        $task = Task::find($id);
        $task->update(['status' => 'complete']);
        $this->sendNotification('Task completed',$task->name.'has been completed successfully');

        return redirect()->route('task.index')
            ->with('success', 'Task created successfully.');
    }
}
