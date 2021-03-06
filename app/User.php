<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users'; //para especificar nombre de la tabla en caso de no seguir la conversion que utiliza laravel
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // OR protected $guarded = ['is_admin'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public static function findByEmail($email){
        return static::where(compact('email'))->first();
    }

    public function profession(){ //profession_id
        return $this->belongsTo(Profession::class);
    }

    public function isAdmin(){
        return $this->is_admin;
    }
}
