<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];


    /**
     * Get the image path .
     *
     * @param  string  $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return asset('storage/posts/'.$value);
    }

    /**
     * format date  created at  .
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('j F Y', strtotime($value));
    }


    /**
     * format date  updated at  .
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j F Y', strtotime($value));
    }
}
