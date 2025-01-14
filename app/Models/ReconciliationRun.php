<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReconciliationRun extends Model
{
    public function template(): BelongsTo
    {
        return $this->belongsTo(ReconciliationTemplate::class);
    }

     public function matches(): HasMany
    {
        return $this->hasMany(ReconciliationMatch::class);
    }
}
