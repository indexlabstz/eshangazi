<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'driver_class',
        'description',
        'user_id'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($platform) {
            $platform->update(['user_id' => auth()->id()]);
        });
    }

    /**
     * Platform may have one or more Members.
     *
     * @return HasMany
     */
    public function member(): HasMany
    {
        return $this->hasMany(Platform::class);
    }

    /**
     * An Item can be created by a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
