<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class District extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'region_id',
        'created_by',
        'updated_by'
    ];

    /**
     * District belong to a region.
     * 
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * District has many wards.
     * 
     * @return HasMany
     */
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    /**
     * District has many Members.
     * 
     * @return HasMany
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    /**
     * District has many Partner.
     * 
     * @return HasMany
     */
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    /**
     * District has many Targets.
     * 
     * @return MorphMany
     */
    public function targets()
    {
        return $this->morphMany(Target::class, 'targetable');
    }

    /**
     * District created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * District updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all of the centers for the district.
     * 
     * @return HasManyThrough
     */
    public function centers()
    {
        return $this->hasManyThrough(Center::class, Ward::class);
    }
}
