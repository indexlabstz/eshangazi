<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'targetable_type',
        'targetable_id',
        'ad_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Target belongs to a location.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function targetable()
    {
        return $this->morphTo();
    }

    /**
     * Target has Ad.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ad()
    {
        return $this->belongsTo();
    }

    /**
     * Target created by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * Target updated by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
