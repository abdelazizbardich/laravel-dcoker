<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    

    protected $fillable = [
        "name",
        "icon"
    ];



    /**
     * Get all of the Deppartment for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Deppartment()
    {
        return $this->hasMany(Deppartment::class, 'categories_id', 'id');
    }
}
