<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeppartmentHasProblem extends Model
{
    use HasFactory;

    protected $table = "user_has_problems";

    protected $fillable = [
        "problem_id",
        "user_id",
    ];


    /**
     * Get all of the Problem for the DeppartmentHasProblem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Problem()
    {
        return $this->hasMany(Problem::class, 'id', 'problem_id');
    }

}
