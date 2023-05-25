<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Model\Tag;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'project_id',
        'creater_id', 'priority', 'status',
        
    ];
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tasks');
    }

    // public function attachments()
    // {
    //     return $this->hasMany(TaskAttachment::class);
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
