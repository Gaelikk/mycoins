<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coin extends Model
{
    use HasFactory;

    protected $table = "coins";
    protected $casts = ["year" => "array"];
    public $timestamps = true;


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'coin_id');
    }
}
