<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    /**
     * Relationship about house with flat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }
}
