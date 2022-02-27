<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationToken extends Model
{
    use HasFactory;

    protected $table = "applicationtoken";

    protected $fillable = [
        "token"
    ];
}
