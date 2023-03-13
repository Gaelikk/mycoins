<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';
    public $timestamps = true;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
