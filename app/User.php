<?php

namespace App;
use Rainwater\Active\Active;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    const USER = 'User';
    const ADMIN = 'Admin';
    const EDITOR ='Editor';
    const EMPLOYEE ='Employee';

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

public function isUser()
{
            return $this->role === 'User';

}
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }
    public function isEditor()
    {
     return $this->role === 'Editor';

    }
    public function isEmployee()
    {
     return $this->role === 'Employee';

    }
}
