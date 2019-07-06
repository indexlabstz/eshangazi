<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description',
        'thumbnail',
        'phone',
        'address',
        'email',
        'website',
        'ward_id',
        'partner_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($center) {
            $center->update(['created_by' => auth()->id()]);
        });
    }

    /**
     * Center is located in a particular Ward.
     * 
     * @return BelongsTo
     */
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    /**
     * Center belongs to a partner.
     * 
     * @return BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Center offer a number of Services.
     * 
     * @return HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    } 

    /**
     * Center created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    

    /**
     * Center updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
