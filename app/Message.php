<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'created_by', 
        'updated_by'
    ];

    /**
     * Get the details of this message.
     * 
     * @return HasMany
     */
    public function message_details()
    {
        return $this->hasMany(MessageDetail::class);
    }

     /**
     * Message created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * Message updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Message saved to the database.
     * 
     * @return Message
     */
    public function persist($message)
    {
        return $this->create([
            'title'         => $message->title,
            'description'   => $message->description,
            'gender'        => $message->gender,
            'minimum_age'   => $message->minimum_age ? $message->minimum_age : 13,
            'created_by'    => auth()->id()
        ]);
    }
}
