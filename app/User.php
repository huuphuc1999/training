<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUserNotDeleted()
    {
        return Self::orderBy('id', 'DESC')->where('is_delete', 0)->paginate(10);
    }
    /**
     * Get group role list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroupRole()
    {
        $role = Self::all();
        return $role->unique('group_role')->pluck('group_role');
    }
    /**
     * Get status user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatusUser()
    {
        $status = Self::all();
        return $status->unique('is_active')->pluck('is_active');
    }
}
