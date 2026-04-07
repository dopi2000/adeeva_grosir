<?php

namespace App\Models;

use App\Models\SalesOrderItem;
use Spatie\ModelStates\HasStates;
use App\States\SalesOrder\Completed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\States\SalesOrder\SalesOrderState;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesOrder extends Model
{

    use HasStates;

    protected $with = ['items'];

    protected $casts = [
        'status' => SalesOrderState::class,
        'payment_payload' => 'json'
    ];

    public function items() : HasMany {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function users() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    
}
