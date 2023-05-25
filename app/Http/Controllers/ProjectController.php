<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\TeamMember;


class ProjectController extends NotificationController
{
    public function index()
    {
        $projects = Project::withCount('tasks')
        ->with('tasks')
        ->get();        
    
        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        $users = User::where('is_admin', 0)->where('is_email_verified', 1)->get();
        return view('dashboard.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'files' => 'nullable|array',
            'tags' => 'nullable|string',
            'files.*' => 'nullable|file|max:2048', // max file size is 2MB
            'team_name' => 'required',
            'team_description' => 'nullable',
            'team_members.*' => 'nullable|exists:users,id'
        ]);
        $tags = explode(',', $request->tags);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();
        $project->tag($tags);
        $project->save();

        if ($request->hasfile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $extenstion = $file->getClientOriginalName();
                $filename = 'Service_file' . rand(1, 9999999999) . $project->id . time() . '.' . $extenstion;
                $file->move('assets/files/projects', $filename);
                $project_file = new ProjectFile();
                $project_file->filename = $filename;
                $project_file->filetype = $file->getClientMimeType();
                $project_file->project_id = $project->id;
                $project_file->save();
            }
            // Add team members to the project
            if ($request->has('team_members')) {
                $team = new Team();
                $team->name = $request->team_name;
                $team->description = '';
                $team->project_id = $project->id;
                $team->save();
        
                foreach ($request->team_members as $userId) {
                    $member = new TeamMember();
                    $member->user_id = $userId;
                    $team->members()->save($member);
                }
            }
        }


        $this->sendNotification('Project Created',$project->name.'has been creaetd successfully');

        return redirect()->route('project.index')
            ->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::with(['teams.members.user'])->find($id);
       
        return view('dashboard.projects.show',compact('project'));
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('dashboard.projects.update', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->update($request->all());
        return  redirect()->rotue('project.index');
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        $this->sendNotification('Project Deleted',$project->name.'has been deleted successfully');
        return  redirect()->rotue('project.index');
    }
}
