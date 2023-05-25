<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\MustVerifyEmail;

  
class User extends Authenticatable 
{
    use HasFactory, Notifiable, HasApiTokens;
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_email_verified',
        'phone',
        'image',
        'profile',
        'location',
        'email_verified_at',
        'api_token'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function teams()
    // {
    //     return $this->belongsToMany(Team::class, 'team_members');
    // }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members')->withTimestamps();
    }
    // public function teams()
    // {
    //     return $this->hasMany(TeamMember::class);
    // }
    
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_users');
    }
}
