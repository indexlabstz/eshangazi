<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method create(array $array)
 */
class Message extends Model
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
        'status',
        'gender',
        'minimum_age',
        'user_id'
    ];

    /**
     * Get the details of this message.
     *
     * @return HasMany
     */
    public function message_details(): HasMany
    {
        return $this->hasMany(MessageDetail::class);
    }

     /**
     * Message created by a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Message saved to the database.
     *
     * @param $message
     * @return Message
     */
    public function persist($message): Message
    {
        return $this->create([
            'title'         => $message->title,
            'description'   => $message->description,
            'gender'        => $message->gender,
            'minimum_age'   => $message->minimum_age,
            'user_id'    => auth()->id()
        ]);
    }
}
