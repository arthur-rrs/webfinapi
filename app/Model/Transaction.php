<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'type',
        'value',
        'note',
        'date_at',
        'account_id',
        'category_id',
        'is_pay'
    ];

    protected $attributes = [
        'is_pay' => 'true',
        'note' => ' '
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
