<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = ['username', 'password', 'info', 'balance', 'card_name', 'card_number', 'card_expiration', 'card_cvv',];

    protected $hidden = ['password'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
