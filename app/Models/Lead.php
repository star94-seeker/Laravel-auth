<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'adress',
        'notes',
        'image',
        'user_id',
    ];




    protected $appends = ['user_name','user_type'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUserNameAttribute()
    {
        $user = $this->User()->first();
        if (isset($user))
            return $user->name;
    }


    public function getUserTypeAttribute()
    {
        $user = $this->User()->first();
        if (isset($user))
            return $user->id;
    }

}
