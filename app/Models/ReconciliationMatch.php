<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReconciliationMatch extends Model
{
    protected $table = 'matches';

    public function reviewers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(ReconciliationTemplate::class);
    }

    public function reconRun(): BelongsTo
    {
        return $this->belongsTo(ReconciliationRun::class);
    }

    public function sourceTransaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'source_transaction_id');
    }
    public function targetTransaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'target_transaction_id');
    }
}
