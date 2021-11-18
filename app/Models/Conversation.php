<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method create(array $array)
 */
class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'intent',
        'member_id',
    ];

    /**
     * Conversation belongs to a member.
     *
     * @return BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function record($intent, $member)
    {
        $this->create([
            'intent'    => $intent,
            'member_id' => $member
        ]);
    }
}
