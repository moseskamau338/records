<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public function template(): BelongsTo
    {
        return $this->belongsTo(ReconciliationTemplate::class);
    }
    public function source(): BelongsTo
    {
        return $this->belongsTo(ReconciliationSource::class);
    }
}
