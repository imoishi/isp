<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    /**
     * Relationship about division with house.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Relationship about district with house.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Relationship about upazila with house.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
