<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
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
