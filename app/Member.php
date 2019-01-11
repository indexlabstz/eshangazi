<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_platform_id', 
        'name', 
        'avatar', 
        'subscribe',
        'born_year',
        'gender',
        'platform_id',
        'district_id',
    ];

    /**
     * A Member belongs to A Platform.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }    
    
    /**
     * A Member belongs to District.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }     
    
    /**
     * A Member may have a number of Conversations.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversations()
    {
        return $this->belongsTo(Conversation::class);
    } 

    /**
     * Member may left a number of Feedback.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Member may leave Rate.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rate()
    {
        return $this->hasOne(Rate::class);
    }
}
