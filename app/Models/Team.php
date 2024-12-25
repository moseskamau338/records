<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The maximum number of teams that can be created.
     *
     * @var int
     */
    public const MAX_TEAMS = 10;

    /**
     * Boot the model.
     */
    protected static function boot():void
    {
        parent::boot();

        static::creating(function ($team) {
            // Check if the team count has reached the maximum allowed
            if (static::count() >= static::MAX_TEAMS) {
                throw new \Exception('Team creation limit has been reached.');
            }
        });
    }
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
