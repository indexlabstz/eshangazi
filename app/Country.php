<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Country extends Model
{  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'code',
        'iso',
        'created_by',
        'updated_by'
    ];

    /**
     * Country has many regions.
     * 
     * @return HasMany
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    /**
     * Country has many Targets.
     * 
     * @return MorphMany
     */
    public function targets()
    {
        return $this->morphMany(Target::class, 'targetable');
    }

    /**
     * Country created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Country updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
