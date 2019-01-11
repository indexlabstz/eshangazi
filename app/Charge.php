<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'name', 
        'description',
        'status', 
        'amount',
        'duration',
        'starts',
        'ends',
        'created_by',
        'updated_by',
    ];

    /**
     * Charge may have one or more Payment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function charge()
    {
        return $this->hasMany(Payment::class);
    } 

    /**
     * Charge created by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Charge updated by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
