<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = ["collection" => "array"];
    protected $table = "users";
    protected $fillable = ['nickname', 'email', 'password', 'name', 'surname', 'avatar', 'country_id'];
    public $timestamps = true;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

}
