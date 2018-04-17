<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $id = 0;
    public $name = "";
    public $email = "";
    public $password = "";
    public $role = "staff";



}
