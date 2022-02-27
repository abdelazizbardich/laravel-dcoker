<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;



    protected $fillable = [
        "name",
        "icon"
    ];



    /**
     * Get all of the Repport for the Problem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Repport()
    {
        return $this->hasMany(Repport::class, 'problems_id','id');
    }

    /**
     * The Deppartment that belong to the Problem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Deppartment()
    {
        return $this->belongsToMany(Deppartment::class, 'deppartment_has_problems', 'deppartment_id', 'problem_id');
    }
}








