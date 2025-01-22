<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantHotFolder extends Model
{
    protected $fillable =  ['app', 'account_id', 'folder'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'folder' => 'json',
        ];
    }
}
