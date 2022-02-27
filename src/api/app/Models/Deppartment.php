<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deppartment extends Model
{
    use HasFactory;


    protected $fillable = [
        "name",
        "phones",
        "lat",
        "lan",
        "username",
        "password",
        "categories_id"
    ];

    protected $casts = [
        "phones" => "array"
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get all of the Problem for the Problem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function Problem()
    {
        return $this->hasManyThrough(Problem::class,DeppartmentHasProblem::class,"deppartment_id","id","id","problem_id");
    }

}
