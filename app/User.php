<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post(){
        // por default fai procurar user_id
        return $this->hasOne('App\Post');
        // se quiser especificar a tabela
        //return $this->hasOne('App\Post','the_user_id');
    }

    public function posts(){
        // To customize tables name and columns the format below
        //return $this->hasMany('App\Post', 'role_user', 'user_id','role_id');
        return $this->hasMany('App\Post');
    }

    public function roles(){
        return $this->belongsToMany('App\Role')->withPivot('created_at');
    }
}
