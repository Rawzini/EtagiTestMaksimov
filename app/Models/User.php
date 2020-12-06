<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function subordinates()
    {
        return $this->hasMany('App\Models\User', 'leader_id');
    }

    public function head()
    {
        return $this->belongsTo('App\Models\User', 'leader_id');
    }

    public function tasksCreator()
    {
        return $this->hasMany('App\Models\User', 'creator_id');
    }

    public function tasksResponsible()
    {
        return $this->hasMany('App\Models\User', 'responsible_id');
    }
}
