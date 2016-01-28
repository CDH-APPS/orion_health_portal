<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedures extends Model
{
    protected $table = 'tbl_claim_procedures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
