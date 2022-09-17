<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Admin as Authenticatable;

class Admin extends Model
{
    use HasFactory;

    protected $guard = 'admins';
    protected $table = 'admins';
    protected $guarded = array();

    // priviledge 1 = super admin, priviledge 2 = view only admin
    protected $fillable = [
        'username', 'email', 'password', 'priviledge'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
