<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;
    protected $table='projects_files';
    protected $fillable = [
        'filename','filetype'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
