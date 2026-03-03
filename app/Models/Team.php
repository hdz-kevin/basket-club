<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the most recent game added for the team
     */
    public function latestGame(): HasOne
    {
        return $this->hasOne(Game::class)->latestOfMany();
    }

    /**
     * Get the game with the most points scored by the team
     */
    public function bestGame(): HasOne
    {
        return $this->hasOne(Game::class)->ofMany('score', 'max');
    }
}
