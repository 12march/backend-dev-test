<?php

namespace App;

Use App\User;
use App\Member;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin', 'name', 'description', 'amount', 'maximum_capacity', 'group_type',
    ];


    /**
     * Get the user that owns the group.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the members record associated with the group.
     */
    public function member()
    {
        return $this->hasMany(Member::class);
    }
}
