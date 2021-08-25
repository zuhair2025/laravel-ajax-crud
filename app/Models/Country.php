<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name','code','continent'];

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
