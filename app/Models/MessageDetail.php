<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'message_id',
        'user_id'
    ];

    /**
     * A Message Detail is belong to a Message.
     *
     * @return BelongsTo
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    /**
    * Message Detail created by a user.
    *
    * @return BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }
}
