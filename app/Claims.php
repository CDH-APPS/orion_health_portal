<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    
	protected $table = 'tbl_claim_entries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

}
