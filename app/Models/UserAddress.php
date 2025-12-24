<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    protected $fillable = ['street_name', 'province', 'city', 'district', 'village', 'postal_code'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
