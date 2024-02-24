<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'title', 'status', 'image' ];

    public function genres()
    {
        return $this->belongsToMany( Genre::class )->withTimestamps();
    }
}
