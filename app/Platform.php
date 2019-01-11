<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'name',
        'driver_class',
        'description',
        'created_by',
        'updated_by'
    ];

    /**
     * Platform may have one or more Members.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member()
    {
        return $this->hasMany(Platform::class);
    }  

    /**
     * Platform may have one or more Ads.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ad()
    {
        return $this->hasMany(Platform::class);
    } 

    /**
     * An Item can be created by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * An Item can be updated by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
