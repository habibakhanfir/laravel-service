<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class Token extends Model
{
    use HasFactory;

    protected $collection = 'tokens';

    protected $fillable = [
        'user_id', 'token'
    ];
}
