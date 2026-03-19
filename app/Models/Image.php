<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
    ];

    protected $visible = ['id', 'url'];

    /**
     * Get the parent imageable model (player or team).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
