<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name','image'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
