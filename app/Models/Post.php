<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates =["deleted_at"];

    protected $collection= "posts";

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'deleted_at'
    ];
    public function likes () {
        return $this->hasMany(Like::class);
    }

}
