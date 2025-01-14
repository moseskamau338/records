<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReconciliationSource extends Model
{
    public function template(): BelongsTo
    {
        return $this->belongsTo(ReconciliationTemplate::class);
    }

    public function transactions(): HasMany
     {
        return $this->hasMany(Transaction::class);
    }
}
