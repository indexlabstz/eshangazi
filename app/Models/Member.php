<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected $with = ['platform'];

    /**
     * A Member belongs to A Platform.
     *
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    /**
     * A Member belongs to District.
     *
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * A Member may have a number of Conversations.
     *
     * @return BelongsTo
     */
    public function conversations(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Member may left a number of Feedback.
     *
     * @return HasMany
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
