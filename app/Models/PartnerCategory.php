<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'name',
        'description',
        'user_id'
    ];

    /**
     * Get the partners of this category.
     *
     * @return HasMany
     */
    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class);
    }

    /**
     * Partner Category created by a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
