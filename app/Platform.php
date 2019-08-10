<?php

namespace App;

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
        'created_by',
        'updated_by'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($platform) {
            $platform->update(['created_by' => auth()->id()]);
        });
    }

    /**
     * Platform may have one or more Members.
     * 
     * @return HasMany
     */
    public function member()
    {
        return $this->hasMany(Platform::class);
    }  

    /**
     * Platform may have one or more Ads.
     * 
     * @return HasMany
     */
    public function ad()
    {
        return $this->hasMany(Platform::class);
    } 

    /**
     * An Item can be created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * An Item can be updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
