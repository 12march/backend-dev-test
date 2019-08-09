<?php

namespace App;

use App\User;
use App\Group;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'unique_id', 'email', 'user_id'];


    /**
     * Get the user that is part of the group.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the group that owns the member.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
