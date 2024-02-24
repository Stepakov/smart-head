<?php

namespace App\Models;

use App\Enums\Movies\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'title', 'status', 'image' ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function genres()
    {
        return $this->belongsToMany( Genre::class )->withTimestamps();
    }

    public function getIsSameTitleAttribute()
    {
//        return true;
        return Movie::where( 'title', $this->title )->exists();
    }


}
