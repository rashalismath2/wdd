<?php

namespace App;

use App\User;
use App\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Lecturer extends Authenticatable
{
    protected $guard='lecturer';
    protected $guarded=[];

}

