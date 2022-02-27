<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repport extends Model
{
    use HasFactory;


    protected $fillable = [
        "lat",
        "long",
        "solved",
        "problems_id",
    ];



    /**
     * Get the Problem that owns the Repport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Problem()
    {
        return $this->belongsTo(Problem::class, 'problems_id', 'id');
    }
}