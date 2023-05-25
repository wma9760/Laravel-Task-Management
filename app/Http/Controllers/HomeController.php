<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        return view('dashboard.index');
    }
    public function userTasks()
    {
        $loggedInUserId = auth()->user()->id;

        // $tasks = Task::whereHas('users', function ($query) use ($loggedInUserId) {
        //     $query->where('users.id', '=', $loggedInUserId);
        // })->with(['project', 'users', 'tags'])->get();
        // $tasks=DB::table('tasks')
        // ->join('projects', 'tasks.project_id', '=', 'projects.id')
        // ->join('teams', 'projects.id', '=', 'teams.project_id')
        // ->join('team_members', 'teams.id', '=', 'team_members.team_id')
        // ->where('team_members.user_id', '=', Auth::user()->id)
        // ->select('tasks.*')
        // ->get();
        $tasks = Task::with('project')
        ->whereHas('project.teams.members', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })
        ->get();
        return view('users.tasks', compact('tasks'));
    }
    public function userProjects()
    {$userId = auth()->user()->id;

        // $projects = Project::whereHas('users', function ($query) use ($userId) {
        //     $query->where('users.id', $userId);
        // })->with(['users', 'tags'])->get();
        $projects = Project::withCount('tasks')
        ->with(['tasks', 'team' => function ($query) {
            $query->whereHas('members', function ($query) {
                $query->where('user_id', auth()->user()->id);
            });
        }])
        ->get();
    //     $projects=DB::table('projects')
    // ->join('teams', 'projects.id', '=', 'teams.project_id')
    // ->join('team_members', 'teams.id', '=', 'team_members.team_id')
    // ->where('team_members.user_id', '=', $userId)
    // ->select('projects.*')
    // ->distinct()
    // ->get();;
        return view('users.projects', compact('projects'));

    }

    public function userAccount()
    {
        return view('users.index');
    }
}
