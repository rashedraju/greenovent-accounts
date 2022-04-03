<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * Get the parent commentable model (post or video).
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
