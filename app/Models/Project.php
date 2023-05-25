<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
use Illuminate\Support\Traits\Tappable;
use Conner\Tagging\Model\Tag;


class Project extends Model
{
    use HasFactory, Tappable, Taggable;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'creater_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_teams');
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function getProgressAttribute()
    {
        $totalTasks = $this->tasks->count();
        $completedTasks = $this->tasks->where('status', 'completed')->count();

        if ($totalTasks > 0) {
            return round(($completedTasks / $totalTasks) * 100);
        }

        return 0;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
    
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
