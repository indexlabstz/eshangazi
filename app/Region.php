<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Region extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Region belong to a country.
     * 
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Region has many districts.
     * 
     * @return HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    /**
     * Region may have one or more ads.
     * 
     * @return HasMany
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * Region has many Targets.
     * 
     * @return MorphMany
     */
    public function targets()
    {
        return $this->morphMany(Target::class, 'targetable');
    }

    /**
     * Region created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Region updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
