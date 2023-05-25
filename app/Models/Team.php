<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'description', 'project_id',
    ];

    

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_users');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}