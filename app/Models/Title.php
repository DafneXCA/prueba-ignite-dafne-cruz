<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'name',
        'requires_sso',
    ];

    protected function casts(): array
    {
        return [
            'requires_sso' => 'boolean',
        ];
    }
}
