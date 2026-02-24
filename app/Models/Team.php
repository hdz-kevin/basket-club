<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'gender',
    ];

    /**
     * Get the games for the team
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
