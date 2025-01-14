<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReconciliationTemplate extends Model
{
     public function runs(): HasMany
     {
        return $this->hasMany(ReconciliationRun::class);
    }
    public function sources(): HasMany
     {
        return $this->hasMany(ReconciliationSource::class);
    }
    public function transactions(): HasMany
     {
        return $this->hasMany(Transaction::class);
    }

    public function matches(): HasMany
     {
        return $this->hasMany(ReconciliationMatch::class);
    }
}
