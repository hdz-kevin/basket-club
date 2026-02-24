<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'is_home',
        'score',
        'opposing_team_name',
        'opposing_team_score',
        'date',
    ];

    /**
     * Get the team that owns the game
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
