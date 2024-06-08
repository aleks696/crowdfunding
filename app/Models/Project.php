<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['info', 'description', 'creator_id', 'balance', 'goal_amount', 'status', 'photo_evidence'];

    protected static function booted()
    {
        static::creating(function ($project) {
            $project->status = 'uncompleted';
            $project->balance = 0;
        });
    }

    public function creator()
    {
        return $this->belongsTo(Customer::class, 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function updateStatus()
    {
        if ($this->balance >= $this->goal_amount) {
            $this->status = 'completed';
        } else {
            $this->status = 'uncompleted';
        }
        $this->save();
    }
    // To show if project is completed
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
