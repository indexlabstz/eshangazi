<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ward extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'district_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Ward belongs to a District.
     * 
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Ward may have one or more Centers.
     * 
     * @return HasMany
     */
    public function centers()
    {
        return $this->hasMany(Center::class);
    }

    /**
     * Ward has many Targets.
     * 
     * @return MorphMany
     */
    public function targets()
    {
        return $this->morphMany(Target::class, 'targetable');
    }

    /**
     * A Ward can be created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * A Ward can be updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
