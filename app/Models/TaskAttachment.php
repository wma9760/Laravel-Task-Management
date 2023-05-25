<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename', 'filetype',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
