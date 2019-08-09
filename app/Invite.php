<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    /**
     * The attributes that mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token', 'group_id'
    ];
}
